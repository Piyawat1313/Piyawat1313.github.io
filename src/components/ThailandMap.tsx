import { useEffect, useRef } from "react";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import geoJsonData from "@/data/thailand-provinces.json";
import { useAppStore } from "@/store/useAppStore";
import { thaiToGeoJsonName, getPriceColorHex } from "@/utils/provinceMapping";

// Reverse mapping: GeoJSON NAME_1 -> Thai name
const geoJsonToThai: Record<string, string> = {};
Object.entries(thaiToGeoJsonName).forEach(([thai, eng]) => {
  geoJsonToThai[eng] = thai;
});

export default function ThailandMap() {
  const mapRef = useRef<HTMLDivElement>(null);
  const leafletMap = useRef<L.Map | null>(null);
  const geoLayerRef = useRef<L.GeoJSON | null>(null);

  const { selectProvince, getAllAvgPrices, selectedProvince } = useAppStore();

  useEffect(() => {
    if (!mapRef.current || leafletMap.current) return;

    const map = L.map(mapRef.current, {
      center: [13.0, 101.0],
      zoom: 6,
      zoomControl: true,
      attributionControl: false,
      maxBounds: [[4, 96], [22, 110]],
      minZoom: 5,
    });

    leafletMap.current = map;

    const avgPrices = getAllAvgPrices();

    const geoLayer = L.geoJSON(geoJsonData as any, {
      style: (feature) => {
        const name1 = feature?.properties?.NAME_1;
        const thaiName = geoJsonToThai[name1];
        const avg = thaiName ? avgPrices.get(thaiName) ?? 0 : 0;
        const color = getPriceColorHex(avg);

        return {
          fillColor: color,
          fillOpacity: 0.75,
          color: "#ffffff",
          weight: 1.5,
          opacity: 1,
        };
      },
      onEachFeature: (feature, layer) => {
        const name1 = feature?.properties?.NAME_1;
        const thaiName = geoJsonToThai[name1];
        if (thaiName) {
          const avg = avgPrices.get(thaiName) ?? 0;
          layer.bindTooltip(
            `${thaiName}${avg > 0 ? ` ฿${avg}` : ""}`,
            { className: "province-tooltip", sticky: true }
          );
        }

        layer.on({
          click: () => {
            if (thaiName) {
              selectProvince(thaiName);
            }
          },
          mouseover: (e) => {
            const l = e.target;
            l.setStyle({ fillOpacity: 0.9, weight: 2.5 });
            l.bringToFront();
          },
          mouseout: (e) => {
            geoLayerRef.current?.resetStyle(e.target);
          },
        });
      },
    }).addTo(map);

    geoLayerRef.current = geoLayer;

    return () => {
      map.remove();
      leafletMap.current = null;
    };
  }, []);

  // Update styles when selectedProvince changes
  useEffect(() => {
    if (!geoLayerRef.current) return;
    const avgPrices = getAllAvgPrices();

    geoLayerRef.current.eachLayer((layer: any) => {
      const feature = layer.feature;
      const name1 = feature?.properties?.NAME_1;
      const thaiName = geoJsonToThai[name1];
      const avg = thaiName ? avgPrices.get(thaiName) ?? 0 : 0;
      const isSelected = thaiName === selectedProvince;

      layer.setStyle({
        fillColor: getPriceColorHex(avg),
        fillOpacity: isSelected ? 0.95 : 0.75,
        color: isSelected ? "#1a1a1a" : "#ffffff",
        weight: isSelected ? 3 : 1.5,
      });

      if (isSelected) layer.bringToFront();
    });
  }, [selectedProvince]);

  return <div ref={mapRef} className="w-full h-full" />;
}
