import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { useAuth } from "@/hooks/useAuth";
import { supabase } from "@/integrations/supabase/client";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { toast } from "sonner";
import { CheckCircle, XCircle, LogOut, Upload, ArrowLeft, Loader2 } from "lucide-react";

interface StoreRow {
  id: string;
  province: string;
  name: string;
  price: number;
  location: string | null;
  status: "pending" | "approved" | "rejected";
  created_at: string;
}

export default function Admin() {
  const { user, loading: authLoading, isAdmin, signOut } = useAuth();
  const navigate = useNavigate();
  const [stores, setStores] = useState<StoreRow[]>([]);
  const [loading, setLoading] = useState(true);
  const [filter, setFilter] = useState<"pending" | "approved" | "rejected" | "all">("pending");
  const [dragOver, setDragOver] = useState(false);
  const [uploading, setUploading] = useState(false);

  useEffect(() => {
    if (!authLoading && !user) navigate("/auth");
  }, [authLoading, user, navigate]);

  useEffect(() => {
    if (!authLoading && user && !isAdmin) {
      toast.error("คุณไม่มีสิทธิ์เข้าถึงหน้านี้");
      navigate("/");
    }
  }, [authLoading, isAdmin, navigate, user]);

  useEffect(() => {
    if (isAdmin) fetchStores();
  }, [isAdmin, filter]);

  const fetchStores = async () => {
    setLoading(true);
    let query = supabase.from("stores").select("*").order("created_at", { ascending: false });
    if (filter !== "all") query = query.eq("status", filter);
    const { data, error } = await query;
    if (error) toast.error(error.message);
    else setStores((data as StoreRow[]) ?? []);
    setLoading(false);
  };

  const updateStatus = async (id: string, status: "approved" | "rejected") => {
    const { error } = await supabase
      .from("stores")
      .update({ status, reviewed_by: user!.id, reviewed_at: new Date().toISOString() })
      .eq("id", id);
    if (error) toast.error(error.message);
    else {
      toast.success(status === "approved" ? "อนุมัติแล้ว" : "ปฏิเสธแล้ว");
      fetchStores();
    }
  };

  const handleFileDrop = async (e: React.DragEvent) => {
    e.preventDefault();
    setDragOver(false);
    const file = e.dataTransfer.files[0];
    if (!file || !file.name.endsWith(".json")) {
      toast.error("กรุณาอัปโหลดไฟล์ .json เท่านั้น");
      return;
    }
    await processJsonFile(file);
  };

  const handleFileSelect = async (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file) return;
    await processJsonFile(file);
    e.target.value = "";
  };

  const processJsonFile = async (file: File) => {
    setUploading(true);
    try {
      const text = await file.text();
      const json = JSON.parse(text);

      // Support priceKrapao.json format: { data: [{ province, store: [...] }] }
      let rows: { province: string; name: string; price: number; location: string | null }[] = [];

      if (json.data && Array.isArray(json.data)) {
        for (const prov of json.data) {
          if (prov.store && Array.isArray(prov.store)) {
            for (const s of prov.store) {
              rows.push({
                province: prov.province,
                name: s.name,
                price: s.prices ?? s.price,
                location: s.location ?? null,
              });
            }
          }
        }
      } else if (Array.isArray(json)) {
        rows = json.map((s: any) => ({
          province: s.province,
          name: s.name,
          price: s.prices ?? s.price,
          location: s.location ?? null,
        }));
      }

      if (rows.length === 0) {
        toast.error("ไม่พบข้อมูลร้านค้าในไฟล์");
        setUploading(false);
        return;
      }

      const inserts = rows.map((r) => ({
        ...r,
        status: "approved" as const,
        submitted_by: user!.id,
        reviewed_by: user!.id,
        reviewed_at: new Date().toISOString(),
      }));

      const { error } = await supabase.from("stores").insert(inserts);
      if (error) toast.error(error.message);
      else {
        toast.success(`นำเข้า ${rows.length} ร้านค้าสำเร็จ`);
        fetchStores();
      }
    } catch {
      toast.error("ไฟล์ JSON ไม่ถูกต้อง");
    }
    setUploading(false);
  };

  if (authLoading || (!isAdmin && user)) {
    return (
      <div className="min-h-screen bg-background flex items-center justify-center">
        <Loader2 className="w-6 h-6 animate-spin text-primary" />
      </div>
    );
  }

  const statusColor = (s: string) => {
    if (s === "approved") return "default";
    if (s === "rejected") return "destructive";
    return "secondary";
  };

  const statusLabel = (s: string) => {
    if (s === "approved") return "อนุมัติ";
    if (s === "rejected") return "ปฏิเสธ";
    return "รอตรวจสอบ";
  };

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <header className="bg-card border-b border-border px-4 py-3 flex items-center justify-between sticky top-0 z-50">
        <div className="flex items-center gap-3">
          <Button variant="ghost" size="icon" onClick={() => navigate("/")}>
            <ArrowLeft className="w-4 h-4" />
          </Button>
          <div>
            <h1 className="text-lg font-bold text-foreground">Admin Dashboard</h1>
            <p className="text-xs text-muted-foreground">จัดการร้านค้า kaprao.map</p>
          </div>
        </div>
        <Button variant="outline" size="sm" onClick={signOut}>
          <LogOut className="w-3.5 h-3.5 mr-1" /> ออกจากระบบ
        </Button>
      </header>

      <div className="max-w-5xl mx-auto p-4 space-y-6">
        {/* JSON Upload */}
        <div
          className={`border-2 border-dashed rounded-xl p-8 text-center transition-colors ${
            dragOver ? "border-primary bg-primary/5" : "border-border"
          }`}
          onDragOver={(e) => { e.preventDefault(); setDragOver(true); }}
          onDragLeave={() => setDragOver(false)}
          onDrop={handleFileDrop}
        >
          <Upload className="w-8 h-8 mx-auto text-muted-foreground mb-2" />
          <p className="text-sm text-muted-foreground mb-2">
            ลากไฟล์ JSON วางที่นี่ หรือ
          </p>
          <label className="cursor-pointer">
            <span className="text-sm text-primary font-medium hover:underline">เลือกไฟล์</span>
            <input type="file" accept=".json" className="hidden" onChange={handleFileSelect} />
          </label>
          {uploading && <p className="text-xs text-muted-foreground mt-2">กำลังนำเข้า...</p>}
        </div>

        {/* Filters */}
        <div className="flex gap-2 flex-wrap">
          {(["pending", "approved", "rejected", "all"] as const).map((f) => (
            <Button
              key={f}
              variant={filter === f ? "default" : "outline"}
              size="sm"
              onClick={() => setFilter(f)}
            >
              {f === "pending" ? "รอตรวจสอบ" : f === "approved" ? "อนุมัติแล้ว" : f === "rejected" ? "ปฏิเสธแล้ว" : "ทั้งหมด"}
            </Button>
          ))}
        </div>

        {/* Store list */}
        {loading ? (
          <div className="flex justify-center py-12">
            <Loader2 className="w-6 h-6 animate-spin text-primary" />
          </div>
        ) : stores.length === 0 ? (
          <p className="text-center text-muted-foreground py-12">ไม่มีข้อมูล</p>
        ) : (
          <div className="space-y-3">
            {stores.map((store) => (
              <div
                key={store.id}
                className="bg-card rounded-xl border border-border p-4 flex items-center justify-between gap-4"
              >
                <div className="flex-1 min-w-0">
                  <div className="flex items-center gap-2 mb-1">
                    <span className="font-semibold text-foreground truncate">{store.name}</span>
                    <Badge variant={statusColor(store.status)}>{statusLabel(store.status)}</Badge>
                  </div>
                  <p className="text-sm text-muted-foreground">
                    {store.province} · ฿{store.price}
                  </p>
                  <p className="text-xs text-muted-foreground">
                    {new Date(store.created_at).toLocaleDateString("th-TH")}
                  </p>
                </div>

                {store.status === "pending" && (
                  <div className="flex gap-2 shrink-0">
                    <Button size="sm" onClick={() => updateStatus(store.id, "approved")}>
                      <CheckCircle className="w-3.5 h-3.5 mr-1" /> อนุมัติ
                    </Button>
                    <Button size="sm" variant="destructive" onClick={() => updateStatus(store.id, "rejected")}>
                      <XCircle className="w-3.5 h-3.5 mr-1" /> ปฏิเสธ
                    </Button>
                  </div>
                )}
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
