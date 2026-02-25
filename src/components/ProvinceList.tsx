import { Search } from "lucide-react";
import { t } from "@/i18n/translations";
import { useAppStore } from "@/store/useAppStore";
import { motion } from "framer-motion";

export default function ProvinceList() {
  const {
    language,
    searchQuery,
    setSearchQuery,
    provinces,
    selectProvince,
    getAvgPrice,
  } = useAppStore();

  const filtered = provinces.filter(
    (p) =>
      p.province.includes(searchQuery) ||
      p.store.some((s) => s.name.includes(searchQuery))
  );

  return (
    <div className="flex flex-col h-full">
      {/* Search */}
      <div className="p-4 border-b border-border">
        <div className="relative">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
          <input
            type="text"
            placeholder={t(language, "search")}
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            className="w-full pl-10 pr-4 py-2.5 bg-secondary rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30"
          />
        </div>
      </div>

      {/* Province List */}
      <div className="flex-1 overflow-y-auto">
        {filtered.map((prov, i) => {
          const avg = getAvgPrice(prov.province);
          return (
            <motion.button
              key={prov.id}
              initial={{ opacity: 0, x: 10 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ delay: i * 0.02 }}
              onClick={() => selectProvince(prov.province)}
              className="w-full text-left px-4 py-3 hover:bg-secondary/80 transition-colors border-b border-border/50 flex items-center justify-between group"
            >
              <span className="font-medium text-sm text-foreground group-hover:text-primary transition-colors">
                {prov.province}
              </span>
              {avg > 0 && (
                <span className="text-xs text-muted-foreground">
                  ฿{avg}
                </span>
              )}
            </motion.button>
          );
        })}
      </div>
    </div>
  );
}
