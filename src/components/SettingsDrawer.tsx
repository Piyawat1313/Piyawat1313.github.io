import { Globe, X, MapPinPlus } from "lucide-react";
import { t } from "@/i18n/translations";
import { useAppStore } from "@/store/useAppStore";
import { motion, AnimatePresence } from "framer-motion";
import type { Language } from "@/types";

const languages: { value: Language; label: string }[] = [
  { value: "th", label: "ภาษาไทย" },
  { value: "en", label: "English" },
  { value: "zh", label: "中文" },
];

export default function SettingsDrawer() {
  const { language, setLanguage, showSettings, setShowSettings, setShowAddStore } = useAppStore();

  return (
    <AnimatePresence>
      {showSettings && (
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          className="fixed inset-0 z-[9998] bg-foreground/30 backdrop-blur-sm"
          onClick={() => setShowSettings(false)}
        >
          <motion.div
            initial={{ x: "-100%" }}
            animate={{ x: 0 }}
            exit={{ x: "-100%" }}
            transition={{ type: "spring", damping: 25, stiffness: 300 }}
            onClick={(e) => e.stopPropagation()}
            className="absolute left-0 top-0 h-full w-72 bg-card shadow-xl p-6"
          >
            <div className="flex items-center justify-between mb-8">
              <h2 className="text-lg font-bold text-foreground tracking-wide">
                {t(language, "settings").toUpperCase()}
              </h2>
              <button
                onClick={() => setShowSettings(false)}
                className="w-8 h-8 rounded-full bg-secondary flex items-center justify-center"
              >
                <X className="w-4 h-4 text-foreground" />
              </button>
            </div>

            {/* Language */}
            <div className="space-y-3 mb-6">
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <Globe className="w-4 h-4" />
                <span>{t(language, "language")}</span>
              </div>
              <div className="space-y-1">
                {languages.map((lang) => (
                  <button
                    key={lang.value}
                    onClick={() => setLanguage(lang.value)}
                    className={`w-full text-left px-3 py-2 rounded-lg text-sm transition-colors ${
                      language === lang.value
                        ? "bg-primary text-primary-foreground font-medium"
                        : "text-foreground hover:bg-secondary"
                    }`}
                  >
                    {lang.label}
                  </button>
                ))}
              </div>
            </div>

            {/* Add store button */}
            <button
              onClick={() => {
                setShowSettings(false);
                setShowAddStore(true);
              }}
              className="w-full flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-foreground hover:bg-secondary transition-colors"
            >
              <MapPinPlus className="w-4 h-4" />
              <span>{t(language, "addStore")}</span>
            </button>
          </motion.div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
