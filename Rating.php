<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rating Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <style>
    .star-btn {
      background: transparent;
      border: none;
      cursor: pointer;
      outline: none;
      transition: color 0.2s ease;
    }
  </style>
</head>

<body class="m-0 p-0 h-screen">
  <div class="w-full h-full flex flex-col">
    <!-- Bagian Rating -->
    <div class="bg-white w-full h-1/2 flex flex-col justify-center items-center">
      <p class="font-bold text-black text-3xl mb-8 ">Berikan Nilai Pesananmu:</p>
      <div class="flex justify-center space-x-3 text-6xl select-none">
        <button aria-label="Rate 1 star" class="star-btn" data-value="1" type="button">
          <i class="fas fa-star text-gray-300"></i>
        </button>
        <button aria-label="Rate 2 stars" class="star-btn" data-value="2" type="button">
          <i class="fas fa-star text-gray-300"></i>
        </button>
        <button aria-label="Rate 3 stars" class="star-btn" data-value="3" type="button">
          <i class="fas fa-star text-gray-300"></i>
        </button>
        <button aria-label="Rate 4 stars" class="star-btn" data-value="4" type="button">
          <i class="fas fa-star text-gray-300"></i>
        </button>
        <button aria-label="Rate 5 stars" class="star-btn" data-value="5" type="button">
          <i class="fas fa-star text-gray-300"></i>
        </button>
      </div>
    </div>

    <!-- Bagian Tombol -->
    <div
      class="bg-gray-300 w-full h-1/2 flex flex-col sm:flex-row items-center justify-center gap-20 px-4">
      
      <button
        class="bg-[#FF9B17] text-white text-sm sm:text-base font-semibold rounded-full px-12 py-4 sm:py-5 w-72 text-center shadow-md hover:bg-[#4e6b81] transition-colors"
        type="button"
        onclick="submitRating()">
        Submit
      </button>
      
      <a href="homepage.php">
        <button
          class="bg-[#FF9B17] text-white text-sm sm:text-base font-semibold rounded-full px-12 py-4 sm:py-5 w-72 text-center shadow-md hover:bg-[#4e6b81] transition-colors"
          type="button">
          Selesai
        </button>
      </a>
    </div>
  </div>

  <script>
    let selectedRating = 0;

    const stars = document.querySelectorAll('.star-btn');
    stars.forEach((star) => {
      star.addEventListener('click', () => {
        selectedRating = parseInt(star.getAttribute('data-value'));
        stars.forEach((s, i) => {
          if (i < selectedRating) {
            s.firstElementChild.classList.remove('text-gray-300');
            s.firstElementChild.classList.add('text-yellow-400');
          } else {
            s.firstElementChild.classList.remove('text-yellow-400');
            s.firstElementChild.classList.add('text-gray-300');
          }
        });
      });
    });

    function ajukanPengembalian() {
      window.location.href = "refund.php";
    }

    function submitRating() {
      if (selectedRating === 0) {
        alert("Silakan pilih rating terlebih dahulu.");
        return;
      }

      const data = {
        rating: selectedRating
      };

      fetch('submit_rating.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            alert("Terima kasih atas penilaiannya!");
            selectedRating = 0;
            stars.forEach(s => {
              s.firstElementChild.classList.remove('text-yellow-400');
              s.firstElementChild.classList.add('text-gray-300');
            });
          } else {
            alert("Gagal mengirim rating, coba lagi.");
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert("Terjadi kesalahan saat mengirim rating.");
        });
    }
  </script>
</body>

</html>
