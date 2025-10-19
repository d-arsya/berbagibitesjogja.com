function NotOpenYet() {
  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-pink-100 via-yellow-100 to-blue-100 text-center px-6 py-10">
      <div className="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 max-w-xl w-full border border-pink-200">
        <h1 className="text-5xl font-extrabold text-pink-500 mb-4">
          🚫 Belum Dibuka!
        </h1>
        <p className="text-lg text-gray-700 font-medium">
          Pendaftaran relawan{" "}
          <span className="text-blue-500 font-semibold">BBJ</span> hanya
          tersedia:
        </p>
        <ul className="mt-4 text-base text-gray-600 space-y-2">
          <li>
            📅{" "}
            <span className="font-semibold text-purple-600">
              Senin pukul 19.00
            </span>
          </li>
          <li>
            ⏳ sampai{" "}
            <span className="font-semibold text-purple-600">
              Minggu pukul 07.00
            </span>
          </li>
        </ul>
        <p className="mt-6 text-sm text-gray-500 italic">
          Yuk kembali lagi di waktu yang sudah ditentukan yaa~ 🤗 <br />
          Makasih banyak atas semangat dan dukunganmu! 🌱💖
        </p>
        <div className="mt-6">
          <img
            src="https://cdn-icons-png.flaticon.com/512/4598/4598774.png"
            alt="Waiting illustration"
            className="w-32 h-32 mx-auto opacity-80"
          />
        </div>
      </div>
    </div>
  );
}

export default NotOpenYet;
