export interface Store {
  id: number;
  prices: number;
  name: string;
  location: string; // Google Maps iframe string
}

export interface ProvinceData {
  id: number;
  province: string;
  store: Store[];
}

export interface CostOfLivingData {
  id: number;
  province: string;
  Minimum_wage: number;
  "living expenses": number;
}

export interface PriceKrapaoData {
  menu_item: string;
  data: ProvinceData[];
}

export interface CostOfLivingFile {
  cost_of_living: CostOfLivingData[];
}

export type Language = "th" | "en" | "zh";

export type ViewState = "list" | "province" | "store";
