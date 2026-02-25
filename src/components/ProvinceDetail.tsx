import { ArrowLeft, MapPin, Wallet, TrendingUp } from "lucide-react";
import { t } from "@/i18n/translations";
import { useAppStore } from "@/store/useAppStore";
import { motion } from "framer-motion";

export default function ProvinceDetail() {
  const {
    language,
    selectedProvince,
    selectProvince,
    getProvinceData,
    getCostData,
    getAvgPrice,
    selectStore,
    setViewState,
    searchQuery,
    setSearchQuery,
  } = useAppStore();

  if (!selectedProvince) return null;

  const provinceData = getProvinceData(selectedProvince);
  const costData = getCostData(selectedProvince);
  const avgPrice = getAvgPrice(selectedProvince);

  const filteredStores = provinceData?.store.filter(
    (s) => !searchQuery || s.name.includes(searchQuery)
  ) ?? [];

  return (
    <motion.div
      initial={{ opacity: 0, x: 20 }}
      animate={{ opacity: 1, x: 0 }}
      exit={{ opacity: 0, x: 20 }}
      className="flex flex-col h-full"
    >
      {/* Header */}
      <div className="p-4 border-b border-border">
        <div className="relative mb-3">
          <button
            onClick={() => {
              selectProvince(null);
              setSearchQuery("");
            }}
            className="flex items-center gap-1 text-sm text-muted-foreground hover:text-foreground transition-colors"
          >
            <ArrowLeft className="w-4 h-4" />
            <span>{t(language, "search")}</span>
          </button>
        </div>

        <h2 className="text-2xl font-bold text-foreground mb-4">{selectedProvince}</h2>

        {/* Stats */}
        <div className="space-y-3">
          {avgPrice > 0 && (
            <div className="flex items-center gap-3">
              <div className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center">
                <Wallet className="w-4 h-4 text-primary" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">{t(language, "avgPrice")}</p>
                <p className="text-lg font-bold text-foreground">฿{avgPrice}</p>
              </div>
            </div>
          )}
          {costData && (
            <div className="flex items-center gap-3">
              <div className="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center">
                <TrendingUp className="w-4 h-4 text-accent" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">{t(language, "costOfLiving")}</p>
                <p className="text-lg font-bold text-foreground">
                  ฿{costData["living expenses"].toLocaleString()}
                </p>
              </div>
            </div>
          )}
        </div>
      </div>

      {/* Search within province */}
      <div className="px-4 py-2 border-b border-border/50">
        <input
          type="text"
          placeholder={t(language, "search")}
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
          className="w-full px-3 py-2 bg-secondary rounded-lg text-sm placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30"
        />
      </div>

      {/* Store list */}
      <div className="flex-1 overflow-y-auto">
        {filteredStores.length === 0 ? (
          <p className="p-4 text-sm text-muted-foreground">{t(language, "noStores")}</p>
        ) : (
          filteredStores.map((store, i) => (
            <motion.button
              key={store.id}
              initial={{ opacity: 0, y: 5 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: i * 0.03 }}
              onClick={() => selectStore(store)}
              className="w-full text-left px-4 py-3 hover:bg-secondary/80 transition-colors border-b border-border/50 flex items-start gap-3"
            >
              <MapPin className="w-4 h-4 mt-0.5 text-destructive flex-shrink-0" />
              <div className="flex-1 min-w-0">
                <p className="text-sm font-medium text-foreground truncate">{store.name}</p>
                <p className="text-xs text-muted-foreground">฿{store.prices}</p>
              </div>
            </motion.button>
          ))
        )}
      </div>
    </motion.div>
  );
}
