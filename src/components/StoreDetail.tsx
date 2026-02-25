import { ArrowLeft, ArrowRight, MapPin } from "lucide-react";
import { t } from "@/i18n/translations";
import { useAppStore } from "@/store/useAppStore";
import { motion } from "framer-motion";
import { useMemo } from "react";

function extractMapSrc(iframeHtml: string): string | null {
  const match = iframeHtml.match(/src=['"](https:\/\/www\.google\.com\/maps\/embed[^'"]*)['"]/);
  return match ? match[1] : null;
}

export default function StoreDetail() {
  const { language, selectedStore, selectStore, selectedProvince } = useAppStore();

  const mapSrc = useMemo(
    () => (selectedStore ? extractMapSrc(selectedStore.location) : null),
    [selectedStore]
  );

  if (!selectedStore) return null;

  return (
    <motion.div
      initial={{ opacity: 0, x: 20 }}
      animate={{ opacity: 1, x: 0 }}
      exit={{ opacity: 0, x: 20 }}
      className="flex flex-col h-full"
    >
      {/* Header */}
      <div className="p-4 border-b border-border">
        <button
          onClick={() => selectStore(null)}
          className="flex items-center gap-1 text-sm text-muted-foreground hover:text-foreground transition-colors mb-3"
        >
          <ArrowLeft className="w-4 h-4" />
          <span>{selectedProvince}</span>
        </button>

        <div className="flex items-center justify-between">
          <h2 className="text-xl font-bold text-foreground">{selectedStore.name}</h2>
          {mapSrc && (
            <a
              href={mapSrc}
              target="_blank"
              rel="noopener noreferrer"
              className="w-8 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-primary/90 transition-colors"
            >
              <ArrowRight className="w-4 h-4 text-primary-foreground" />
            </a>
          )}
        </div>
      </div>

      {/* Map */}
      {mapSrc && (
        <div className="mx-4 mt-4 rounded-xl overflow-hidden border border-border aspect-video">
          <iframe
            src={mapSrc}
            width="100%"
            height="100%"
            style={{ border: 0 }}
            allowFullScreen
            loading="lazy"
            referrerPolicy="no-referrer-when-downgrade"
            title={selectedStore.name}
          />
        </div>
      )}

      {/* Details */}
      <div className="p-4 space-y-4">
        <div className="flex items-center gap-3">
          <div className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center">
            <MapPin className="w-4 h-4 text-primary" />
          </div>
          <div>
            <p className="text-xs text-muted-foreground">{t(language, "price")}</p>
            <p className="text-lg font-bold text-foreground">฿{selectedStore.prices}</p>
          </div>
        </div>
      </div>
    </motion.div>
  );
}
