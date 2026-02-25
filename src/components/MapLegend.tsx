import { t } from "@/i18n/translations";
import { useAppStore } from "@/store/useAppStore";

export default function MapLegend() {
  const { language } = useAppStore();

  return (
    <div className="flex flex-col gap-1.5 bg-card/90 backdrop-blur-sm rounded-lg p-3 shadow-sm">
      <div className="flex items-center gap-2">
        <div className="w-4 h-4 rounded-sm bg-price-cheap" />
        <span className="text-xs text-foreground">{t(language, "legendCheap")}</span>
      </div>
      <div className="flex items-center gap-2">
        <div className="w-4 h-4 rounded-sm bg-price-mid" />
        <span className="text-xs text-foreground">{t(language, "legendMid")}</span>
      </div>
      <div className="flex items-center gap-2">
        <div className="w-4 h-4 rounded-sm bg-price-expensive" />
        <span className="text-xs text-foreground">{t(language, "legendExpensive")}</span>
      </div>
    </div>
  );
}
