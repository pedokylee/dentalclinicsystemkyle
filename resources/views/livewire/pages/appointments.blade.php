<!-- Appointment Section -->
<section id="appointment" class="py-20 bg-gradient-to-r from-blue-600 to-blue-400 text-white">
  <div class="max-w-5xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Book an Appointment</h2>
      <p class="text-blue-100 text-lg">
        Schedule your visit with our experienced dental team — it only takes a minute.
      </p>
    </div>

    <!-- Appointment Form Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
      <form wire:submit.prevent="submitAppointment" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Full Name -->
          <div>
            <label class="block text-sm font-semibold text-blue-700 mb-2">Full Name</label>
            <input type="text" wire:model.defer="name" required
                   class="w-full border border-blue-200 rounded-md px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                   placeholder="John Doe">
          </div>

          <!-- Email -->
          <div>
            <label class="block text-sm font-semibold text-blue-700 mb-2">Email Address</label>
            <input type="email" wire:model.defer="email" required
                   class="w-full border border-blue-200 rounded-md px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                   placeholder="john@example.com">
          </div>

          <!-- Phone -->
          <div>
            <label class="block text-sm font-semibold text-blue-700 mb-2">Phone Number</label>
            <input type="tel" wire:model.defer="phone" required
                   class="w-full border border-blue-200 rounded-md px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                   placeholder="(555) 123-4567">
          </div>

          <!-- Date -->
          <div>
            <label class="block text-sm font-semibold text-blue-700 mb-2">Preferred Date</label>
            <input type="date" wire:model.defer="date" required
                   class="w-full border border-blue-200 rounded-md px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
          </div>

          <!-- Service -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-blue-700 mb-2">Service Type</label>
            <select wire:model.defer="service" required
                    class="w-full border border-blue-200 rounded-md px-4 py-3 text-gray-700 bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
              <option value="">Select a Service</option>
              <option value="cleaning">Teeth Cleaning</option>
              <option value="whitening">Teeth Whitening</option>
              <option value="braces">Orthodontics (Braces)</option>
              <option value="extraction">Tooth Extraction</option>
              <option value="checkup">Routine Checkup</option>
            </select>
          </div>

          <!-- Message -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-blue-700 mb-2">Additional Notes</label>
            <textarea wire:model.defer="message"
                      rows="4"
                      class="w-full border border-blue-200 rounded-md px-4 py-3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                      placeholder="Tell us about any specific concerns or questions..."></textarea>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center pt-4">
          <button type="submit"
                  class="px-10 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition">
            Submit Appointment
          </button>
        </div>
      </form>
    </div>

    <!-- Success Message (Optional Example) -->
    {{-- 
    <div class="mt-8 text-center">
      <p class="bg-green-100 text-green-700 inline-block px-6 py-3 rounded-md font-medium">
        ✅ Your appointment request has been submitted successfully!
      </p>
    </div>
    --}}
  </div>
</section>
