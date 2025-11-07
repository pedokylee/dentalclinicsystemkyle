  <div>
  <!-- Hero Section -->
  <section id="hero" class="bg-gradient-to-r from-blue-50 to-white">
    <div class="max-w-7xl mx-auto px-6 py-24 flex flex-col md:flex-row items-center justify-between">
      <div class="md:w-1/2 text-center md:text-left space-y-6">
        <h1 class="text-4xl md:text-6xl font-bold text-blue-700 leading-tight">
          Bright Smiles, Healthy Lives.
        </h1>
        <p class="text-gray-600 text-lg">
          At <span class="font-semibold text-blue-600">iTeeth Dental Clinic</span>, we combine modern dental care with a gentle touch to make every visit comfortable and confident.
        </p>
        <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
          <a wire:click.prevent='toAppointment' class="px-8 py-3 bg-blue-600 text-white rounded-md font-medium shadow-lg hover:bg-blue-700 transition">
            Book Appointment
          </a>
          <a wire:click.prevent='toServices' class="px-8 py-3 border border-blue-600 text-blue-600 rounded-md font-medium hover:bg-blue-50 transition">
            View Services
          </a>
        </div>
      </div>
{{-- 
      <div class="md:w-1/2 mt-10 md:mt-0">
        <img src="https://cdn.pixabay.com/photo/2016/03/23/08/34/dentist-1276266_1280.jpg" alt="Dental Care" class="rounded-2xl shadow-lg w-full">
      </div>
    </div> --}}
  </section>

<!-- Contact & Appointment CTA -->
<section id="contact" class="py-20 bg-gradient-to-r from-blue-600 to-blue-400 text-white text-center">
  <div class="max-w-3xl mx-auto px-6">
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Let’s Keep Your Smile Bright</h2>
    <p class="text-white/90 mb-8">Contact us for inquiries or schedule your appointment today.</p>
    <a wire:click='toAppointment'
       class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-md shadow-md hover:bg-blue-50 transition">
      Book Appointment
    </a>
  </div>
</section>

  </div>