import { create } from "zustand";
import { Language, ViewState, ProvinceData, Store, CostOfLivingData } from "@/types";
import priceData from "@/data/priceKrapao.json";
import costData from "@/data/cost-of-living.json";

interface AppState {
  language: Language;
  setLanguage: (lang: Language) => void;

  viewState: ViewState;
  setViewState: (state: ViewState) => void;

  selectedProvince: string | null;
  selectProvince: (province: string | null) => void;

  selectedStore: Store | null;
  selectStore: (store: Store | null) => void;

  searchQuery: string;
  setSearchQuery: (query: string) => void;

  showAddStore: boolean;
  setShowAddStore: (show: boolean) => void;

  showSettings: boolean;
  setShowSettings: (show: boolean) => void;

  // Data
  provinces: ProvinceData[];
  costOfLiving: CostOfLivingData[];

  getProvinceData: (provinceName: string) => ProvinceData | undefined;
  getCostData: (provinceName: string) => CostOfLivingData | undefined;
  getAvgPrice: (provinceName: string) => number;
  getAllAvgPrices: () => Map<string, number>;
}

export const useAppStore = create<AppState>((set, get) => ({
  language: "th",
  setLanguage: (lang) => set({ language: lang }),

  viewState: "list",
  setViewState: (state) => set({ viewState: state }),

  selectedProvince: null,
  selectProvince: (province) => set({
    selectedProvince: province,
    viewState: province ? "province" : "list",
    selectedStore: null,
  }),

  selectedStore: null,
  selectStore: (store) => set({
    selectedStore: store,
    viewState: store ? "store" : "province",
  }),

  searchQuery: "",
  setSearchQuery: (query) => set({ searchQuery: query }),

  showAddStore: false,
  setShowAddStore: (show) => set({ showAddStore: show }),

  showSettings: false,
  setShowSettings: (show) => set({ showSettings: show }),

  provinces: (priceData as any).data ?? [],
  costOfLiving: (costData as any).cost_of_living ?? [],

  getProvinceData: (name) => {
    return get().provinces.find((p) => p.province === name);
  },

  getCostData: (name) => {
    return get().costOfLiving.find((c) => c.province === name);
  },

  getAvgPrice: (name) => {
    const prov = get().provinces.find((p) => p.province === name);
    if (!prov || prov.store.length === 0) return 0;
    const total = prov.store.reduce((sum, s) => sum + s.prices, 0);
    return Math.round(total / prov.store.length);
  },

  getAllAvgPrices: () => {
    const map = new Map<string, number>();
    get().provinces.forEach((p) => {
      if (p.store.length > 0) {
        const avg = p.store.reduce((sum, s) => sum + s.prices, 0) / p.store.length;
        map.set(p.province, Math.round(avg));
      }
    });
    return map;
  },
}));
