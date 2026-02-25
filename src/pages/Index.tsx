import { Settings, MapPinPlus, Globe, ChevronUp } from "lucide-react";
import { useAppStore } from "@/store/useAppStore";
import { t } from "@/i18n/translations";
import { useIsMobile } from "@/hooks/use-mobile";
import ThailandMap from "@/components/ThailandMap";
import MapLegend from "@/components/MapLegend";
import ProvinceList from "@/components/ProvinceList";
import ProvinceDetail from "@/components/ProvinceDetail";
import StoreDetail from "@/components/StoreDetail";
import AddStoreModal from "@/components/AddStoreModal";
import SettingsDrawer from "@/components/SettingsDrawer";
import { AnimatePresence, motion } from "framer-motion";
import { useState } from "react";

export default function Index() {
  const {
    language,
    viewState,
    setShowAddStore,
    setShowSettings,
  } = useAppStore();
  const isMobile = useIsMobile();
  const [mobileSheetOpen, setMobileSheetOpen] = useState(false);

  return (
    <div className="h-screen w-screen overflow-hidden flex flex-col relative">
      {/* Modals */}
      <AddStoreModal />
      <SettingsDrawer />

      {isMobile ? (
        /* ===== MOBILE LAYOUT ===== */
        <>
          {/* Top bar */}
          <div className="absolute top-0 left-0 right-0 z-[1000] flex items-center gap-2 px-3 py-2 bg-card/90 backdrop-blur-sm">
            <div className="flex-1 relative">
              <input
                type="text"
                placeholder={t(language, "search")}
                className="w-full pl-3 pr-3 py-2 bg-secondary rounded-lg text-sm placeholder:text-muted-foreground focus:outline-none"
                onFocus={() => setMobileSheetOpen(true)}
                onChange={(e) => useAppStore.getState().setSearchQuery(e.target.value)}
                value={useAppStore.getState().searchQuery}
              />
            </div>
            <button
              onClick={() => setShowSettings(true)}
              className="w-9 h-9 rounded-full bg-secondary flex items-center justify-center"
            >
              <Settings className="w-4 h-4 text-foreground" />
            </button>
          </div>

          {/* Map */}
          <div className="flex-1">
            <ThailandMap />
          </div>

          {/* Legend */}
          <div className="absolute top-14 left-3 z-[1000]">
            <MapLegend />
          </div>

          {/* Brand */}
          <div className="absolute bottom-16 left-3 z-[1000]">
            <div className="bg-card/90 backdrop-blur-sm rounded-lg px-3 py-2">
              <p className="text-xs font-bold text-foreground">kaprao.map</p>
              <p className="text-[10px] font-bold text-primary">{t(language, "appTitle")}</p>
              <p className="text-[10px] text-muted-foreground">{t(language, "appSubtitle")}</p>
            </div>
          </div>

          {/* Bottom bar */}
          <div className="absolute bottom-0 left-0 right-0 z-[1000] bg-card border-t border-border flex items-center justify-around py-2 px-4">
            <button
              onClick={() => setMobileSheetOpen(!mobileSheetOpen)}
              className="flex items-center gap-1 text-xs text-foreground font-medium px-3 py-1.5 rounded-full bg-secondary"
            >
              <Globe className="w-3.5 h-3.5" />
              <span>{t(language, "language")}</span>
              <ChevronUp className={`w-3 h-3 transition-transform ${mobileSheetOpen ? "rotate-180" : ""}`} />
            </button>
            <button
              onClick={() => setShowAddStore(true)}
              className="flex items-center gap-1 text-xs text-foreground font-medium px-3 py-1.5 rounded-full bg-secondary"
            >
              <MapPinPlus className="w-3.5 h-3.5" />
              <span>{t(language, "addStore")}</span>
            </button>
          </div>

          {/* Mobile slide-up sheet */}
          <AnimatePresence>
            {mobileSheetOpen && (
              <motion.div
                initial={{ y: "100%" }}
                animate={{ y: 0 }}
                exit={{ y: "100%" }}
                transition={{ type: "spring", damping: 25, stiffness: 300 }}
                className="absolute bottom-12 left-0 right-0 z-[999] bg-card rounded-t-2xl shadow-2xl max-h-[70vh] overflow-hidden flex flex-col"
              >
                <div
                  className="flex justify-center py-2 cursor-pointer"
                  onClick={() => setMobileSheetOpen(false)}
                >
                  <div className="w-10 h-1 bg-border rounded-full" />
                </div>
                <div className="flex-1 overflow-hidden">
                  {viewState === "list" && <ProvinceList />}
                  {viewState === "province" && <ProvinceDetail />}
                  {viewState === "store" && <StoreDetail />}
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </>
      ) : (
        /* ===== DESKTOP LAYOUT ===== */
        <div className="flex h-full">
          {/* Map area */}
          <div className="flex-1 relative">
            <ThailandMap />

            {/* Legend overlay */}
            <div className="absolute top-4 left-4 z-[1000]">
              <MapLegend />
            </div>

            {/* Bottom bar overlay */}
            <div className="absolute bottom-4 left-4 z-[1000] flex items-center gap-3">
              <button
                onClick={() => setShowSettings(true)}
                className="flex items-center gap-1.5 text-xs font-medium px-3 py-2 rounded-lg bg-card/90 backdrop-blur-sm shadow-sm text-foreground hover:bg-card transition-colors"
              >
                <Globe className="w-3.5 h-3.5" />
                <span>{t(language, "language")}</span>
              </button>
              <button
                onClick={() => setShowAddStore(true)}
                className="flex items-center gap-1.5 text-xs font-medium px-3 py-2 rounded-lg bg-card/90 backdrop-blur-sm shadow-sm text-foreground hover:bg-card transition-colors"
              >
                <MapPinPlus className="w-3.5 h-3.5" />
                <span>{t(language, "addStore")}</span>
              </button>
            </div>
          </div>

          {/* Right panel */}
          <div className="w-[380px] bg-card border-l border-border flex flex-col h-full overflow-hidden">
            {/* Brand header */}
            <div className="p-4 border-b border-border">
              <p className="text-sm font-semibold text-muted-foreground tracking-wider">kaprao.map</p>
              <h1 className="text-3xl font-bold text-primary leading-tight">{t(language, "appTitle")}</h1>
              <p className="text-sm font-medium text-foreground">{t(language, "appSubtitle")}</p>
            </div>

            {/* Content */}
            <div className="flex-1 overflow-hidden">
              <AnimatePresence mode="wait">
                {viewState === "list" && (
                  <motion.div key="list" className="h-full" initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }}>
                    <ProvinceList />
                  </motion.div>
                )}
                {viewState === "province" && (
                  <motion.div key="province" className="h-full" initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }}>
                    <ProvinceDetail />
                  </motion.div>
                )}
                {viewState === "store" && (
                  <motion.div key="store" className="h-full" initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }}>
                    <StoreDetail />
                  </motion.div>
                )}
              </AnimatePresence>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
