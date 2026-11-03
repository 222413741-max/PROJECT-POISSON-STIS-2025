/*
  Sengaja dicomment dengan alasan:
  - Sebelum ini, setiap orang harus menyesuaikan base_url dengan APP_URL pada .env
  - Dengan menyisakan path saja, setiap orang tidak perlu lagi menyesuaikan base_url.
    Sehingga memudahkan bila siap deploy

  export const base_url = "https://dev-poisson.dev"; // Sesuaikan dengan APP_URL pada .env
  export const logo = `${base_url}/img/logo.svg`;
  export const olimstatImg = `${base_url}/img/olimpiade-statistika.png`;
  export const infografisImg = `${base_url}/img/infografis.png`;
  export const semnasImg = `${base_url}/img/semnas.png`;
  export const semnasBg = `${base_url}/img/bg-semnas.png`;
  export const dnImg = `${base_url}/img/dn.png`;
  export const dnBg = `${base_url}/img/bg-dn.png`;
*/

export const logo = `/img/landing-page/landing/LOGO POISSON 2025.png`;
export const olimstatImg = `/img/landing-page/landing/SO.svg`;
export const infografisImg = `/img/landing-page/landing/SI.svg`;
export const offstatImg = `/img/landing-page/landing/OSC.svg`;
export const semnasImg = `/img/landing-page/landing/logoSemnas.svg`;
export const mainHeroBg = `/img/landing-page/landing/backgroundHero.svg`;
export const subHeroBg = `/img/landing-page/landing/backgroundSubHero.svg`;
export const lombaBg = `/img/landing-page/landing/backgroundLomba.svg`;
export const semnasBg = `/img/landing-page/landing/backgroundSemnas.svg`;
export const timelineBg = `/img/landing-page/landing/backgroundTimeline.svg`;
export const faqBg = `/img/landing-page/landing/backgroundFAQ.svg`;
export const galleryBg = `/img/landing-page/landing/backgroundGallery.svg`;
export const footerBg = `/img/landing-page/landing/backgroundFooter.png`;
export const dnImg = `/img/dn.png`;
export const dnBg = `/img/bg-dn.png`;

//Transisi
export const transisiHero = `/img/landing-page/landing/transisiHero.svg`;
export const transisiSubHeroTop = `/img/landing-page/landing/transisiSubHeroTop.svg`;
export const transisiSubHeroBottom = `/img/landing-page/landing/transisiSubHeroBottom.svg`;
export const transisiLombaTop = `/img/landing-page/landing/transisiLombaTop.svg`;
export const transisiLombaBottom = `/img/landing-page/landing/transisiLombaBottom.svg`;
export const transisiSemnasTop = `/img/landing-page/landing/transisiSemnasTop.svg`;
export const transisiSemnasBottom = `/img/landing-page/landing/transisiSemnasBottom.svg`;
export const transisiTimelineTop = `/img/landing-page/landing/transisiTimelineTop.svg`;
export const transisiTimelineBottom = `/img/landing-page/landing/transisiTimelineBottom.svg`;
export const transisiFAQTop = `/img/landing-page/landing/transisiFAQTop.svg`;
export const transisiFAQBottom = `/img/landing-page/landing/transisiFAQBottom.svg`;
export const transisiGaleriTop = `/img/landing-page/landing/transisiGaleriTop.svg`;
export const transisiGaleriBottom = `/img/landing-page/landing/transisiGaleriBottom.svg`;
export const transisiFooter = `/img/landing-page/landing/transisiFooterTop.svg`;

export default {
    lomba: [
        {
            imageSrc: olimstatImg,
            title: "Statistics Olympiads",
            description:
                "Menguji pemahaman dan penerapan statistika dalam kompetisi skala nasional",
            link: "https://drive.google.com/file/d/1rnXgLAASfiBlY8-y4HSgfED-aXMTP73A/view?usp=sharing",
        },
        {
            imageSrc: infografisImg,
            title: "Statistical Infographics",
            description:
                "Representasi visual yang menyajikan informasi kompleks secara ringkas dan mudah dipahami",
            link: "https://drive.google.com/file/d/1YoeL27raIswweJCjIMXPsskTo5ey4cqR/view?usp=drivesdk",
        },
        {
            imageSrc: offstatImg,
            title: "Official Statistics Challenge",
            description: "Pemahaman dalam mengkaji official statistics",
            link: "https://drive.google.com/file/d/1DQ7uwncPLjmsW0vN7dMdQ6wsGP-oPWPf/view?usp=drivesdk",
            modul: "https://drive.google.com/file/d/1TPw2_gIYBXpnfq56F02rDXb5wFq6fOgO/view?usp=drivesdk",
        },
    ],
    faqs: [
        {
            question:
                "Apakah mahasiswa boleh mendaftar pada 2 cabang lomba sekaligus?",
            answer: "Mahasiswa diperbolehkan mendaftar pada kedua cabang lomba sekaligus, dengan catatan jika keduanya masuk final hanya boleh memilih salah satu lomba saja.",
        },
        {
            question:
                " Jika sudah melalui sidang skripsi, tapi status kartu mahasiswa masih aktif sampai akhir masa pendaftaran apakah masih boleh mengikuti lomba?",
            answer: "Peserta diharuskan berstatus mahasiswa aktif sampai kegiatan POISSON berakhir.",
        },
        {
            question:
                "Bagaimana saya mengetahui bahwa pendaftaran tim saya berhasil dilakukan?",
            answer: "Peserta bisa mengecek notifikasi di email yang didaftarkan atau melihat status akun di website.",
        },
        {
            question:
                "Bagaimana jika terdapat kendala saat akan mengumpulkan jawaban melalui website?",
            answer: "Jawaban dapat dikirimkan melalui email POISSON dan konfirmasi kepada narahubung perlombaan terkait.",
        },
        {
            question:
                "Jika belum memiliki kartu tanda mahasiswa, apakah boleh diganti dengan kartu identitas lainnya?",
            answer: "Boleh menggunakan kartu atau surat tanda mahasiswa yang menyatakan bahwa benar peserta merupakan mahasiswa aktif di perguruan tinggi.",
        },
        {
            question:
                "Apakah peserta diperbolehkan mengganti anggota tim dalam tahapan perlombaan?",
            answer: "Peserta tidak diperbolehkan mengganti atau menukar anggota tim.",
        },
        {
            question:
                "Apakah diperbolehkan jika dalam satu tim terdiri dari 2 anggota yang berasal dari jurusan berbeda?",
            answer: "Boleh. Asalkan dalam satu tim tersebut berasal dari perguruan tinggi yang sama.",
        },
        {
            question:
                "Bagaimana jika kami memiliki kesulitan atau pertanyaan lain selama proses pendaftaran?",
            answer: "Silakan hubungi kami melalui contact person.",
        },
    ],
    link: [
        // {
        //   name: "Beranda",
        //   url: "/",
        // },
        {
            name: "Home",
            url: "#hero",
        },
        {
            name: "Competitions",
            url: "#lomba",
        },
        {
            name: "Semnas",
            url: "#semnas",
        },
        // {
        //   name: 'News',
        //   url: '#berita',
        // },
        {
            name: "FAQ",
            url: "#faq",
        },
        {
            name: "Gallery",
            url: "#galeri",
        },
    ],
    timeline: [
        {
            title: "Pendaftaran Lomba Statistics Olympiad",
            date: "2 - 30 September 2025",
        },
        {
            title: "Pendaftaran Lomba Statistical Infographic",
            date: "2 - 30 September 2025",
        },
        {
            title: "Pendaftaran Lomba Official Statistics Challenge",
            date: "2 - 30 September 2025",
        },
        {
            title: "Tahap I Infografis : Penyisihan (Pengumpulan Karya)",
            date: "2 September - 3 Oktober 2025",
        },
        {
            title: "Seminar Nasional (SEMNAS)",
            date: "19 September 2025",
        },
        {
            title: "Opening Ceremony",
            date: "10 Oktober 2025",
        },
        {
            title: "Tahap I Olimpiade : Penyisihan",
            date: "10 Oktober 2025",
        },
        {
            title: "Tahap I OSC : Penyisihan",
            date: "11 Oktober 2025",
        },
        {
            title: "Pengumuman Tahap I OSC",
            date: "15 Oktober 2025",
        },
        {
            title: "Pengumuman Tahap I Olimpiade",
            date: "17 Oktober 2025",
        },
        {
            title: "Pengumuman 10 Besar Infografis",
            date: "18 Oktober 2025",
        },
        {
            title: "Pengumuman Tahap I Infografis",
            date: "31 Oktober 2025",
        },
        {
            title: "Tahap II Olimpiade : Semifinal",
            date: "1-8 November 2025",
        },
        {
            title: "Tahap II OSC : Semifinal",
            date: "2 November 2025",
        },
        {
            title: "Pengumuman Tahap II OSC",
            date: "7 November 2025",
        },
        {
            title: "Pengumuman Tahap II Olimpiade",
            date: "13 November 2025",
        },
        {
            title: "Tahap II Infografis : Final",
            date: "16 November 2025",
        },
        {
            title: "Tahap III Olimpiade : Final",
            date: "28 November 2025",
        },
        {
            title: "Tahap III OSC : Final",
            date: "28 November 2025",
        },
        {
            title: "Closing Ceremony",
            date: "28 November 2025",
        },
    ],
    galeries: [
        {
            title: "POISSON 2021",
            src: "/img/galeri/2021_1.png",
        },
        {
            title: "POISSON 2021",
            src: "/img/galeri/2021_2.png",
        },
        {
            title: "POISSON 2022",
            src: "/img/galeri/2022_1.jpg",
        },
        {
            title: "POISSON 2022",
            src: "/img/galeri/2022_2.jpg",
        },
        {
            title: "POISSON 2023",
            src: "/img/galeri/2023_1.jpg",
        },
        {
            title: "POISSON 2023",
            src: "/img/galeri/2023_2.png",
        },
        {
            title: "POISSON 2024",
            src: "/img/galeri/2024_1.jpg",
        },
        {
            title: "POISSON 2024",
            src: "/img/galeri/2024_2.jpg",
        },
    ],
    news: [
        {
            id: 1,
            title: "Perdana Hybrid : Opening Ceremony dan Tahap Penyisihan Olimpiade POISSON 2022",
            date: "5 Juni 2023",
            thumbnail: "/img/berita/berita_1.jpg",
            content:
                "Pekan Olimpiade dan Infografis Nasional atau yang disebut dengan POISSON pada tahun 2022 telah dibuka. Tanda dibuka secara resminya kompetisi ini yakni dengan adanya Opening Ceremony POISSON 2022 yang diselenggarakan pada Sabtu, 27 Agustus 2022 . Untuk pertama kalinya, POISSON mengadakan event secara hybrid. Panitia, dosen pembina, dan beberapa undangan menghadiri acara secara langsung di Auditorium Politeknik Statistika STIS. Sedangkan, seluruh peserta lomba mengikuti secara dalam jaringan (daring) melalui media Zoom Meeting. Metode hybrid ini dipandang tepat karena mahasiswa Politeknik Statistika STIS sebagai panitia pelaksana kala itu sudah melangsungkan perkuliahan secara offline ke kampus sehingga memungkinkan untuk mengadakan event bersama di kampus. Acara ini berlangsung dari pagi pukul 08.00 WIB. Acara dimulai dengan pembukaan oleh Master of Ceremony (MC) dan doa. Kemudian, menyanyikan lagu Indonesia Raya. Acara selanjutnya adalah sambutan-sambutan. Pertama, sambutan dan sekaligus pembukaan Opening Ceremony oleh Wakil Direktur III Politeknik Statistika STIS yakni Bapak Ir. Agus Purwoto, M.Si. Kedua, sambutan dari Ketua Pelaksana POISSON 2022 yaitu Kak Muhammad Erza Lesmana. Ketiga, sambutan dari Ketua Senat Mahasiswa yang kala itu diwakilkan oleh Kak Athoillah Zakky Ramdhani sebagai Koordinator Udikbud. Beberapa dosen yang turut hadir dalam Opening Ceremony ini yakni Bapak Dr. Azka Ubaidillah, S.ST., M.Si. selaku dosen pendamping UKM Forkas periode 2022/2023 dan Ibu Siskarossa Ika Oktora, SST, M.Stat, selaku perwakilan undangan dari pihak dosen. Setelah itu, acara Opening Ceremony juga dihiasi dengan hiburan dari band Xbar dan Paduan Suara Excelsior Polstat STIS. Acara kemudian dilanjutkan dengan pengumuman mengenai babak pertama Olimpiade Statistika yaitu Babak Penyisihan yang akan dilakukan pada agenda siang hari. Opening Ceremony POISSON 2022 berlangsung dengan lancar. Seluruh pihak yang berkumpul di auditorium menyempatkan diri untuk mendokumentasikan momen tersebut dengan berfoto bersama. Agenda selanjutnya adalah Tahap Pertama Penyisihan Olimpiade Statistika. Tahap pertama dilakukan secara online melalui website POISSON. Peserta mengunduh soal kemudian mengerjakan soal dalam jangka waktu yang telah disediakan. Selanjutnya, peserta mengunggah jawaban pada sistem di dalam website POISSON. Acara penyisihan berjalan dengan lancar. Seluruh peserta mengerjakan dengan baik dan tepat waktu. Sistem website juga aman dan tidak ada kendala yang berarti.",
            author: "Esti Barsua",
        },
        {
            id: 2,
            title: "Ada Apa di Semifinal Olimpiade POISSON 2022 ?",
            date: "10 Juni 2023",
            thumbnail: "/img/berita/berita_2.jpg",
            content:
                "Tidak terasa pelaksanaan Olimpiade Statistika dalam Pekan Olimpiade dan Infografis Nasional atau POISSON 2022 telah dimulai. Tahap pertama adalah tahap penyisihan yang dilaksanakan pada Minggu, 28 Agustus 2022 dan tahap berikutnya yaitu semifinal yang dilaksanakan pada Minggu, 11 September 2022 pada pukul 09.00 s.d. 11.00 WIB . Terdapat 25 tim yang berhasil lolos ke tahap semifinal dan tentunya telah siap untuk bersaing dalam babak ini untuk merebutkan lima tempat di babak final perlombaan yang sangat dinanti. Pelaksanaan pada tahap semifinal ini sama dengan tahap penyisihan, yaitu dilakukan secara hybrid, dimana peserta akan mengerjakan secara online dan akan diawasi oleh panitia melalui zoom meeting. Acara dimulai pada pukul 08.00 WIB yang diawali dengan open gate peserta semifinal dan diikuti oleh pembukaan dan doa. Lalu terdapat pemberitahuan tentang breakout room dan LO dan pengerjaan semifinal dimulai. Saat mengerjakan soal, peserta memasuki ruang virtual Zoom Meeting sesuai dengan pembagian room yang sudah diberitahukan sebelumnya. Soal semifinal terbagi menjadi 5 grade yaitu grade A, grade B, grade C, grade D, dan grade E. Tiap grade memiliki bobot yang berbeda dimana soal dengan grade A memiliki bobot paling tinggi dan soal dengan grade E memiliki bobot paling rendah. Hasil dari pengerjaan para peserta tentunya akan dikoreksi oleh juri-juri yang berpengalaman dan keren tentunya. Pemberitahuan mengenai peserta yang lolos ke babak final akan diinformasikan melalui situs website Poisson dengan pemberitahuan lewat email dan grup WhatsApp pada Sabtu, 17 September 2022. pada tahap semifinal terdapat lima tim yang berhasil lolos ke babak final, yaitu tim Sukses PKL dari Politeknik Statistika STIS, tim skuymabarguys dari Institut Teknologi Sepuluh November, tim Ravenclaw dari IPB University, tim LeastSq dari Politeknik Statistika STIS, dan tim pure dari Politeknik Statistika STIS. Dengan babak semifinal yang berakhir, semangat dan antusiasme para peserta semakin membara untuk menghadapi babak final yang akan menjadi puncak kompetisi. Babak final ini akan menyajikan tantangan baru bagi para peserta dalam upaya mereka untuk memperebutkan piala dan gelar juara Olimpiade Statistika POISSON 2022. Acara ini menyoroti kehebatan peserta dalam mengolah data, mengungkapkan tren yang signifikan, dan memberikan wawasan yang berharga melalui statistika.",
            author: "Risma Alifiyanti",
        },
        {
            id: 3,
            title: "Final Olimpiade dan Infografis POISSON 2022",
            date: "15 Juni 2023",
            thumbnail: "/img/berita/berita_3.jpg",
            content:
                "Setelah seluruh peserta menunjukkan kemampuannya pada babak penyisihan dan semifinal, peserta kemudian berpindah pada babak selanjutnya yaitu babak final. Peserta pada babak final merupakan lima peserta terbaik pada cabang lomba olimpiade dan 10 peserta terbaik pada cabang lomba infografis. Babak final dari tiap-tiap cabang lomba tersebut telah dilaksanakan pada Sabtu, 1 Oktober 2022. Pada lomba olimpiade statistika, peserta yang mengikuti babak final diminta melakukan analisis data berdasarkan topik yang disediakan panitia. Data yang digunakan boleh berasal dari BPS maupun berasal dari badan resmi lainnya. Peserta diberikan waktu pengerjaan selama sepekan, kemudian hasil analisisnya dipresentasikan di hadapan dewan juri dalam bentuk PowerPoint selama 15 menit kemudian diikuti dengan sesi tanya jawab selama 15 menit pada hari babak final dilaksanakan. Pada babak final cabang lomba infografis, setiap tim menyiapkan presentasi mengenai infografis yang telah dibuat. Setiap tim melakukan presentasi selama 20 menit termasuk sesi tanya jawab. Selain melakukan presentasi, 10 karya terbaik dan video reels akan diunggah di akun instagram poisson untuk diambil juara favorit berdasarkan jumlah likes terbanyak. Peserta yang lolos yang kemudian berkompetisi pada babak final berasal dari berbagai perguruan tinggi di Indonesia. Pada cabang lomba olimpiade, lima tim yang lolos pada babak final di antaranya yaitu UGM dan UNS yang tiap-tiap universitas tersebut meloloskan satu tim, sedangkan tiga tim lainnya berasal dari Politeknik Statistika STIS. Untuk cabang lomba infografis, 10 tim yang berkompetisi pada babak final di antaranya yaitu dari UNS, UGM, Polstat STIS, dan beberapa perguruan tinggi lainnya. Pada kegiatan selanjutnya yaitu closing ceremony, setelah babak final terlaksana, diumumkan perguruan tinggi yang menjadi juara umum berdasarkan hasil perolehan juara pada cabang lomba olimpiade dan infografis. ",
            author: "La Ode Rafiq Zandik Badarun",
        },
        {
            id: 4,
            title: "Closing Ceremony POISSON 2022 x Fantastis",
            date: "20 Juni 2023",
            thumbnail: "/img/berita/berita_4.jpg",
            content:
                "Pada Minggu, 2 Oktober 2022, tidak terasa tahapan Olimpiade Statistika dalam Pekan Olimpiade dan Infografis Nasional atau POISSON 2022 telah berakhir sejak dimulainya pada tanggal 27 Agustus 2022. Closing Ceremony POISSON 2023 berkolaborasi dengan acara Festival Akademik dan Seni Polstat STIS (Fantastis), yang merupakan kegiatan Charity Concert dan menjadi bagian dari perayaan Dies Natalis Polstat STIS ke-64. Acara ini dilaksanakan secara hybrid. Finalis, tamu undangan, serta mahasiswa Polstat STIS dapat menyaksikan secara langsung di Auditorium Polstat STIS, sementara masyarakat umum dan peserta yang berhalangan hadir dapat menyaksikan siaran langsung di kanal Youtube Dies Natalis Politeknik Statistika STIS. Acara pembukaan dimulai pada pukul 12.35 WIB oleh Master of Ceremony (MC), lalu dilanjutkan dengan sambutan-sambutan. Setelah itu, para hadirin disuguhkan dengan penampilan dari UKM kesenian Polstat STIS, seperti UKM tari Paradise, Paduan Suara Excelsior, serta band Xbar. Acara kemudian mencapai puncaknya pada pengumuman pemenang POISSON 2023 cabang lomba Olimpiade Statistika dan Infografis. Juara 3 cabang lomba Infografis diraih oleh tim Epsilon dari Polstat STIS, tim X-ponen dari UGM sebagai juara 2, dan GedhangKluthuk dari UNS sebagai juara pertama. Juara infografis favorit diperoleh tim X-ponen UGM, dengan perolehan likes terbanyak pada postingan Instagram @poisson_stis. Sementara pada cabang lomba Olimpiade Statistika, juara harapan 2 diraih oleh tim Pure dari Polstat STIS, diikuti oleh tim SkuyMabarGuys asal ITS sebagai juara harapan 1, lalu tim LeastSQ dari Polstat STIS sebagai juara 3, tim Ravenclaw dari IPB sebagai juara 2, dan tim Sukses PKL asal Polstat STIS sebagai juara pertama. Juara Best Analysist diperoleh tim Sukses PKL Polstat STIS. Berdasarkan banyaknya tim yang lolos sebagai juara, Polstat STIS meraih gelar juara umum pada POISSON 2022. Agenda berikutnya merupakan publikasi dari hasil pengumpulan donasi. Acara kemudian ditutup oleh Bapak Yunarso Anang, sekaligus menandai berakhirnya rangkaian lomba POISSON 2022.",
            author: "Fathiyah Nur Shohwah",
        },
    ],
};
