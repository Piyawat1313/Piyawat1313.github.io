import { useState } from "react";
import { X } from "lucide-react";
import { t } from "@/i18n/translations";
import { useAppStore } from "@/store/useAppStore";
import { motion, AnimatePresence } from "framer-motion";
import { toast } from "sonner";

export default function AddStoreModal() {
  const { language, showAddStore, setShowAddStore } = useAppStore();
  const [price, setPrice] = useState("");
  const [location, setLocation] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    if (!price || !location) return;

    // In a real app this would go to backend
    toast.success(t(language, "submissionNote"));
    setPrice("");
    setLocation("");
    setShowAddStore(false);
  };

  return (
    <AnimatePresence>
      {showAddStore && (
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          className="fixed inset-0 z-[9999] flex items-center justify-center bg-foreground/40 backdrop-blur-sm p-4"
          onClick={() => setShowAddStore(false)}
        >
          <motion.div
            initial={{ scale: 0.95, opacity: 0 }}
            animate={{ scale: 1, opacity: 1 }}
            exit={{ scale: 0.95, opacity: 0 }}
            onClick={(e) => e.stopPropagation()}
            className="bg-card rounded-2xl shadow-xl w-full max-w-md p-6"
          >
            <div className="flex items-center justify-between mb-6">
              <h3 className="text-xl font-bold text-foreground">
                {t(language, "addStoreTitle")}
              </h3>
              <button
                onClick={() => setShowAddStore(false)}
                className="w-8 h-8 rounded-full bg-secondary flex items-center justify-center hover:bg-secondary/80"
              >
                <X className="w-4 h-4 text-foreground" />
              </button>
            </div>

            <form onSubmit={handleSubmit} className="space-y-4">
              <div>
                <input
                  type="number"
                  placeholder={t(language, "storePrice")}
                  value={price}
                  onChange={(e) => setPrice(e.target.value)}
                  className="w-full px-4 py-3 bg-secondary rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30"
                  min="1"
                  max="999"
                  required
                />
              </div>

              <div>
                <input
                  type="text"
                  placeholder={t(language, "storeLocation")}
                  value={location}
                  onChange={(e) => setLocation(e.target.value)}
                  className="w-full px-4 py-3 bg-secondary rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30"
                  required
                />
              </div>

              <div className="bg-secondary/60 rounded-lg p-3">
                <p className="text-xs text-muted-foreground whitespace-pre-line">
                  {t(language, "embedInstructions")}
                </p>
              </div>

              <button
                type="submit"
                className="w-full py-3 bg-primary text-primary-foreground rounded-lg font-semibold text-sm hover:bg-primary/90 transition-colors"
              >
                {t(language, "submit")}
              </button>

              <p className="text-xs text-center text-muted-foreground">
                {t(language, "submissionNote")}
              </p>
            </form>
          </motion.div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
