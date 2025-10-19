import DataDisplay from "./DataDisplay";
import NotOpenYet from "./NotOpenYet";
import { useEffect, useState } from "react";

// function App() {
//   return (
//     <>
//       <DataDisplay />
//     </>
//   );
// }
function App() {
  const [isOpen, setIsOpen] = useState(false);

  useEffect(() => {
    const JAM_BUKA = 19;
    const HARI_BUKA = 1;
    const HARI_TUTUP = 7;
    const JAM_TUTUP = 15;
    const now = new Date();
    const currentDay = now.getDay(); // Minggu = 0, Senin = 1, ..., Sabtu = 6
    const currentHour = now.getHours();
    const currentMinutes = now.getMinutes();

    // Hitung waktu buka: Senin 19:00
    const openDate = new Date(now);
    openDate.setDate(now.getDate() + ((1 - currentDay + 7) % 7)); // next Monday
    openDate.setHours(19, 0, 0, 0); // 19:00:00

    // Hitung waktu tutup: Minggu 15:00
    const closeDate = new Date(now);
    closeDate.setDate(now.getDate() + ((0 - currentDay + 7) % 7)); // next Sunday
    closeDate.setHours(15, 0, 0, 0); // 15:00:00

    // Kasus khusus: jika sekarang setelah Senin 19:00 tapi sebelum Minggu 15:00
    const isAfterOpen =
      now.getDay() > HARI_BUKA ||
      (now.getDay() === HARI_BUKA &&
        (currentHour > JAM_BUKA ||
          (currentHour === JAM_BUKA && currentMinutes >= 0)));

    const isBeforeClose =
      now.getDay() < 0 ||
      (now.getDay() === 0 &&
        (currentHour < JAM_TUTUP ||
          (currentHour === JAM_TUTUP && currentMinutes === 0)));

    let open = false;

    if (
      (currentDay === HARI_BUKA && currentHour >= JAM_BUKA) || // Senin mulai 19:00
      (currentDay > HARI_BUKA && currentDay < HARI_TUTUP) || // Selasa - Sabtu
      (currentDay === 0 && currentHour < JAM_TUTUP) // Minggu sebelum 15:00
    ) {
      open = true;
    }

    setIsOpen(open);
  }, []);

  return <>{isOpen ? <DataDisplay /> : <NotOpenYet />}</>;
}

export default App;
