<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Contact</title>
</head>
<body>
 @include('includes.header')

<!-- Hero Section -->
<section class="bg-blue-500 text-white text-center py-12 px-4">
  <h2 class="text-2xl">📡 Need information, assistance, or a partnership?</h2>
  <h3 class="text-base font-medium">Our team is here to respond to all your inquiries quickly and efficiently.</h3>
</section>

<!-- Contact Section -->
<section class="bg-gray-50 py-16 px-4">
  <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-xl p-8 md:p-10 grid grid-cols-1 md:grid-cols-3 gap-6">

   <!-- Left Box -->
<div class="bg-blue-900 text-white rounded-lg p-6 md:col-span-1 flex flex-col justify-center">
  <div>
    <h3 class="text-xl font-bold mb-4">🤔 Have a question ?</h3>
    <p class="text-sm mb-2">📬 Our team is available for any inquiries: partnership , platform improvement requests , affiliation or any other questions .</p>
    <p class="text-sm">Simply fill out this form, and we’ll get back to you within 72 hours.</p>
  </div>
</div>

    <!-- Contact Form -->
    <form class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
      
      <div class="col-span-2">
        <label class="block mb-1">Title</label>
        <select class="w-full border rounded px-3 py-2">
          <option>Select</option>
          <option>Mr.</option>
          <option>Mrs.</option>
        </select>
      </div>

      <div>
        <label class="block mb-1">First Name</label>
        <input type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        <label class="block mb-1">Last Name</label>
        <input type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        <label class="block mb-1">Email</label>
        <input type="email" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        
       <label class="block mb-1">Phone Code</label>
     <select class="w-full border rounded px-3 py-2">
  <option value="+1">+1 (United States)</option>
<option value="+44">+44 (United Kingdom)</option>
<option value="+33">+33 (France)</option>
<option value="+49">+49 (Germany)</option>
<option value="+39">+39 (Italy)</option>
<option value="+34">+34 (Spain)</option>
<option value="+351">+351 (Portugal)</option>
<option value="+31">+31 (Netherlands)</option>
<option value="+32">+32 (Belgium)</option>
<option value="+41">+41 (Switzerland)</option>
<option value="+43">+43 (Austria)</option>
<option value="+353">+353 (Ireland)</option>
<option value="+47">+47 (Norway)</option>
<option value="+46">+46 (Sweden)</option>
<option value="+45">+45 (Denmark)</option>
<option value="+358">+358 (Finland)</option>
<option value="+48">+48 (Poland)</option>
<option value="+420">+420 (Czech Republic)</option>
<option value="+421">+421 (Slovakia)</option>
<option value="+36">+36 (Hungary)</option>
<option value="+30">+30 (Greece)</option>
<option value="+385">+385 (Croatia)</option>
<option value="+386">+386 (Slovenia)</option>
<option value="+381">+381 (Serbia)</option>
<option value="+387">+387 (Bosnia and Herzegovina)</option>
<option value="+389">+389 (North Macedonia)</option>
<option value="+382">+382 (Montenegro)</option>
<option value="+355">+355 (Albania)</option>
<option value="+359">+359 (Bulgaria)</option>
<option value="+40">+40 (Romania)</option>
<option value="+370">+370 (Lithuania)</option>
<option value="+371">+371 (Latvia)</option>
<option value="+372">+372 (Estonia)</option>
<option value="+380">+380 (Ukraine)</option>
<option value="+373">+373 (Moldova)</option>
<option value="+995">+995 (Georgia)</option>
<option value="+374">+374 (Armenia)</option>
<option value="+7">+7 (Russia)</option>
<option value="+90">+90 (Turkey)</option>
<option value="+354">+354 (Iceland)</option>
<option value="+352">+352 (Luxembourg)</option>
<option value="+423">+423 (Liechtenstein)</option>
<option value="+356">+356 (Malta)</option>
<option value="+377">+377 (Monaco)</option>
<option value="+378">+378 (San Marino)</option>
<option value="+379">+379 (Vatican City)</option>
<option value="+376">+376 (Andorra)</option>
<option value="+383">+383 (Kosovo)</option>
<option value="+357">+357 (Cyprus)</option>


  <!-- Add more as needed -->
</select>

      </div>

      <div class="col-span-2">
        <label class="block mb-1">Phone Number</label>
        <input type="tel" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="col-span-2">
        <label class="block mb-1">Address (Line 1)</label>
        <input type="text" class="w-full border rounded px-3 py-2" placeholder="Street, number..." />
      </div>

      <div class="col-span-2">
        <label class="block mb-1">Address (Additional)</label>
        <input type="text" class="w-full border rounded px-3 py-2" placeholder="Apartment, building..." />
      </div>

      <div>
        <label class="block mb-1">Postal Code</label>
        <input type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <div>
        <label class="block mb-1">City</label>
        <input type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="col-span-2">
        <label class="block mb-1">Country</label>
        <select class="w-full border rounded px-3 py-2">
          <option>Select your country</option>
        <option value="United States">United States</option>
<option value="United Kingdom">United Kingdom</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Italy">Italy</option>
<option value="Spain">Spain</option>
<option value="Portugal">Portugal</option>
<option value="Netherlands">Netherlands</option>
<option value="Belgium">Belgium</option>
<option value="Switzerland">Switzerland</option>
<option value="Austria">Austria</option>
<option value="Ireland">Ireland</option>
<option value="Norway">Norway</option>
<option value="Sweden">Sweden</option>
<option value="Denmark">Denmark</option>
<option value="Finland">Finland</option>
<option value="Poland">Poland</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Slovakia">Slovakia</option>
<option value="Hungary">Hungary</option>
<option value="Greece">Greece</option>
<option value="Croatia">Croatia</option>
<option value="Slovenia">Slovenia</option>
<option value="Serbia">Serbia</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="North Macedonia">North Macedonia</option>
<option value="Montenegro">Montenegro</option>
<option value="Albania">Albania</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Romania">Romania</option>
<option value="Lithuania">Lithuania</option>
<option value="Latvia">Latvia</option>
<option value="Estonia">Estonia</option>
<option value="Ukraine">Ukraine</option>
<option value="Moldova">Moldova</option>
<option value="Georgia">Georgia</option>
<option value="Armenia">Armenia</option>
<option value="Russia">Russia</option>
<option value="Turkey">Turkey</option>
<option value="Iceland">Iceland</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Malta">Malta</option>
<option value="Monaco">Monaco</option>
<option value="San Marino">San Marino</option>
<option value="Vatican City">Vatican City</option>
<option value="Andorra">Andorra</option>
<option value="Kosovo">Kosovo</option>
<option value="Cyprus">Cyprus</option>


        </select>
      </div>

      <div class="col-span-2">
  <label class="block mb-1" for="comments">Comments</label>
  <textarea id="comments" class="w-full border rounded px-3 py-2" rows="4" placeholder="Enter your details here..."></textarea>
</div>


      <div class="col-span-2 flex items-start gap-2">
        <input type="checkbox" class="mt-1" />
        <label class="text-xs text-gray-600">
          I accept the <a href="#" class="text-green-600 underline">terms and conditions</a>.
        </label>
      </div>

      <div class="col-span-2">
        <button type="submit" class="w-full bg-blue-900 text-white font-semibold py-2 rounded-full">
          Submit
        </button>
      </div>
    </form>
  </div>
</section>

 @include('includes.footer')
</body>
</html>