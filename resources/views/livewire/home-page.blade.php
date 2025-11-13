<div>
  <!-- Hero Section -->
  <section id="hero" 
    class="relative bg-blue-100 overflow-hidden"
    style="background-image: url('https://t4.ftcdn.net/jpg/07/76/42/13/360_F_776421379_SI3pB0jpC1PmT5goSGvZzwK5L1afMlZV.jpg'); 
           background-size: cover; 
           background-position: center;">
    
      
    <div class="relative max-w-7xl mx-auto px-6 py-24 flex flex-col md:flex-row items-center justify-between">
      
      <!-- Text Content (Left) -->
      <div class="md:w-1/2 text-center md:text-left text-white space-y-6">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight">
          Bright Smiles, Healthy Lives.
        </h1>
        <p class="text-blue-100 text-lg">
          At <span class="font-semibold text-blue-700">iTeeth Dental Clinic</span>, we combine modern dental care with a gentle touch to make every visit comfortable and confident.
        </p>
        <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
          <a wire:click.prevent='toAppointment' 
             class="px-8 py-3 bg-white text-blue-400 rounded-md font-medium shadow-lg hover:bg-blue-50 transition">
            Book Appointment
          </a>
          <a wire:click.prevent='toServices' 
             class="px-8 py-3 border border-white text-white rounded-md font-medium hover:bg-white/10 transition">
            View Services
          </a>
        </div>
      </div>

      <!-- Image (Right) -->
      <div class="md:w-1/2 mt-12 md:mt-0 flex justify-center">
        
      </div>

    </div>
  </section>

  <!-- Contact & Appointment CTA -->
  <section id="contact" class="py-20 bg-gradient-to-r from-blue-600 to-green-400 text-white text-center">
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
