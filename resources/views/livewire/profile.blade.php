<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
  <div class="max-w-7xl mx-auto">
      <h1 class="text-4xl font-bold text-navy mb-10 text-center">My Profile</h1>
      
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
          <!-- Profile Sidebar -->
          <div class="lg:col-span-1">
              <div class="bg-white rounded-xl shadow-lg p-6 mb-6 transition transform hover:shadow-xl">
                  <div class="flex flex-col items-center text-center">
                      <!-- Profile Photo -->
                      <div class="relative w-36 h-36 mb-6">
                          @if($profile_photo)
                              <img src="{{ asset('storage/' . $profile_photo) }}" alt="Profile Photo" class="w-full h-full rounded-full object-cover border-4 border-light-wood shadow-md">
                              <button wire:click="removePhoto" class="absolute bottom-0 right-0 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-all duration-300 shadow-md" title="Remove Photo">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                  </svg>
                              </button>
                          @else
                              <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center border-4 border-light-wood shadow-md">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                  </svg>
                              </div>
                          @endif
                      </div>
                      
                      <h2 class="text-2xl font-bold text-navy">{{ $name }}</h2>
                      <p class="text-gray-600 mb-4 flex items-center justify-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-navy" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                              <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                          </svg>
                          {{ $email }}
                      </p>
                      
                      <!-- Navigation -->
                      <div class="w-full mt-6 space-y-3">
                          <button onclick="document.getElementById('profile-tab').click()" class="w-full text-left py-3 px-4 rounded-lg flex items-center hover:bg-navy hover:text-white transition-all duration-300">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                              </svg>
                              Personal Information
                          </button>
                          <button onclick="document.getElementById('password-tab').click()" class="w-full text-left py-3 px-4 rounded-lg flex items-center hover:bg-navy hover:text-white transition-all duration-300">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                              </svg>
                              Change Password
                          </button>
                          <button onclick="document.getElementById('orders-tab').click()" class="w-full text-left py-3 px-4 rounded-lg flex items-center hover:bg-navy hover:text-white transition-all duration-300">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                              </svg>
                              Order History
                          </button>
                      </div>
                  </div>
              </div>
              
              <!-- Quick Stats -->
              <div class="bg-white rounded-xl shadow-lg p-6 hidden lg:block">
                  <h3 class="text-lg font-semibold text-navy mb-4 flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                      </svg>
                      Profile Summary
                  </h3>
                  <div class="space-y-3">
                      <div class="flex justify-between items-center">
                          <span class="text-gray-600">Member Since</span>
                          <span class="font-medium">{{ date('M d, Y', strtotime('-' . rand(1, 24) . ' months')) }}</span>
                      </div>
                      <div class="flex justify-between items-center">
                          <span class="text-gray-600">Total Orders</span>
                          <span class="font-medium">{{ count($orders) }}</span>
                      </div>
                      <div class="flex justify-between items-center">
                          <span class="text-gray-600">Last Login</span>
                          <span class="font-medium">{{ date('M d, Y') }}</span>
                      </div>
                  </div>
              </div>
          </div>
          
          <!-- Profile Content -->
          <div class="lg:col-span-3">
              <div class="bg-white rounded-xl shadow-lg p-6" x-data="{ activeTab: 'profile' }">
                  <!-- Tabs -->
                  <div class="border-b border-gray-200 mb-6">
                      <div class="flex flex-wrap -mb-px">
                          <button 
                              id="profile-tab"
                              @click="activeTab = 'profile'" 
                              :class="{'text-navy border-b-2 border-navy font-bold': activeTab === 'profile',
                                      'text-gray-500 hover:text-navy hover:border-gray-300 border-b-2 border-transparent': activeTab !== 'profile'}"
                              class="mr-8 py-4 px-1 font-medium flex items-center transition-all duration-300">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                              </svg>
                              Personal Information
                          </button>
                          <button 
                              id="password-tab"
                              @click="activeTab = 'password'" 
                              :class="{'text-navy border-b-2 border-navy font-bold': activeTab === 'password',
                                      'text-gray-500 hover:text-navy hover:border-gray-300 border-b-2 border-transparent': activeTab !== 'password'}"
                              class="mr-8 py-4 px-1 font-medium flex items-center transition-all duration-300">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                              </svg>
                              Change Password
                          </button>
                          <button 
                              id="orders-tab"
                              @click="activeTab = 'orders'" 
                              :class="{'text-navy border-b-2 border-navy font-bold': activeTab === 'orders',
                                      'text-gray-500 hover:text-navy hover:border-gray-300 border-b-2 border-transparent': activeTab !== 'orders'}"
                              class="py-4 px-1 font-medium flex items-center transition-all duration-300">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                              </svg>
                              Order History
                          </button>
                      </div>
                  </div>
                  
                  <!-- Personal Information -->
                  <div x-show="activeTab === 'profile'" x-cloak>
                      <form wire:submit.prevent="updateProfile" class="space-y-6">
                          <div class="bg-gray-50 p-4 rounded-lg mb-6 flex items-start">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                              <p class="text-sm text-gray-600">Update your personal information to keep your account up to date.</p>
                          </div>
                          
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                              <div>
                                  <label for="profile_photo" class="block text-gray-700 font-medium mb-2">Profile Photo</label>
                                  <div class="flex items-center">
                                      <label for="profile_photo" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md transition duration-300 flex items-center">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                              <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                          </svg>
                                          Choose Photo
                                      </label>
                                      <input type="file" wire:model.live="tempPhoto" id="profile_photo" class="hidden">
                                  </div>
                                  @error('tempPhoto') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                  
                                  @if ($tempPhoto)
                                      <div class="mt-3">
                                          <p class="text-sm text-gray-500 mb-2">Photo Preview:</p>
                                          <img src="{{ $tempPhoto->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover border-2 border-light-wood">
                                      </div>
                                  @endif
                              </div>

                              <div>
                                  <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                                  <div class="relative">
                                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                          </svg>
                                      </div>
                                      <input type="text" wire:model.live="name" id="name" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-navy focus:ring focus:ring-navy focus:ring-opacity-50 transition duration-300">
                                  </div>
                                  @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                              </div>
                              
                              <div>
                                  <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                                  <div class="relative">
                                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                              <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                              <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                          </svg>
                                      </div>
                                      <input type="email" wire:model.live="email" id="email" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-navy focus:ring focus:ring-navy focus:ring-opacity-50 transition duration-300">
                                  </div>
                                  @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                              </div>
                              
                              <div>
                                  <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                                  <div class="relative">
                                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                              <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                          </svg>
                                      </div>
                                      <input type="tel" wire:model.live="phone" id="phone" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-navy focus:ring focus:ring-navy focus:ring-opacity-50 transition duration-300">
                                  </div>
                                  @error('phone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                              </div>
                          </div>
                          
                          <div>
                              <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                              <div class="relative">
                                  <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                      </svg>
                                  </div>
                                  <textarea wire:model.live="address" id="address" rows="3" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-navy focus:ring focus:ring-navy focus:ring-opacity-50 transition duration-300"></textarea>
                              </div>
                              @error('address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                          </div>
                          
                          <div class="flex justify-end">
                              <button type="submit" class="bg-navy hover:bg-light-navy text-white font-medium py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                      <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                                  </svg>
                                  Update Profile
                              </button>
                          </div>
                      </form>
                  </div>
                  
                  <!-- Change Password -->
                  <div x-show="activeTab === 'password'" x-cloak>
                      <div class="bg-gray-50 p-4 rounded-lg mb-6 flex items-start">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                          </svg>
                          <div>
                              <p class="text-sm text-gray-600">Create a strong password to protect your account.</p>
                              <p class="text-xs text-gray-500 mt-1">Use at least 8 characters with a mix of letters, numbers, and symbols.</p>
                          </div>
                      </div>
                  
                      <form wire:submit.prevent="updatePassword" class="space-y-6">
                          <div>
                              <label for="current_password" class="block text-gray-700 font-medium mb-2">Current Password</label>
                              <div class="relative">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                      </svg>
                                  </div>
                                  <input type="password" wire:model.live="current_password" id="current_password" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-navy focus:ring focus:ring-navy focus:ring-opacity-50 transition duration-300">
                              </div>
                              @error('current_password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                          </div>
                          
                          <div>
                              <label for="new_password" class="block text-gray-700 font-medium mb-2">New Password</label>
                              <div class="relative">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                      </svg>
                                  </div>
                                  <input type="password" wire:model.live="new_password" id="new_password" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-navy focus:ring focus:ring-navy focus:ring-opacity-50 transition duration-300">
                              </div>
                              @error('new_password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                          </div>
                          
                          <div>
                              <label for="confirm_password" class="block text-gray-700 font-medium mb-2">Confirm New Password</label>
                              <div class="relative">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                      </svg>
                                  </div>
                                  <input type="password" wire:model.live="confirm_password" id="confirm_password" class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-navy focus:ring focus:ring-navy focus:ring-opacity-50 transition duration-300">
                              </div>
                              @error('confirm_password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                          </div>
                          
                          <div class="flex justify-end">
                              <button type="submit" class="bg-navy hover:bg-light-navy text-white font-medium py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                  </svg>
                                  Update Password
                              </button>
                          </div>
                      </form>
                  </div>
                  
                  <!-- Order History -->
                  <div x-show="activeTab === 'orders'" x-cloak>
                      @if(count($orders) > 0)
                          <div class="overflow-x-auto bg-white rounded-lg">
                              <table class="min-w-full divide-y divide-gray-200">
                                  <thead>
                                      <tr class="bg-gray-50">
                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody class="bg-white divide-y divide-gray-200">
                                      @foreach($orders as $order)
                                          <tr class="hover:bg-gray-50 transition-colors duration-200">
                                              <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm font-medium text-navy">{{ $order->order_number }}</div>
                                              </td>
                                              <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm text-gray-700">{{ date('M d, Y', strtotime($order->created_at)) }}</div>
                                              </td>
                                              <td class="px-6 py-4 whitespace-nowrap">
                                                  <div class="text-sm font-medium text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                                              </td>
                                              <td class="px-6 py-4 whitespace-nowrap">
                                                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                      @if($order->status == 'delivered') bg-green-100 text-green-800
                                                      @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                                      @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                                      @else bg-yellow-100 text-yellow-800
                                                      @endif">
                                                      {{ ucfirst($order->status) }}
                                                  </span>
                                              </td>
                                              <td class="px-6 py-4 whitespace-nowrap">
                                                  <a href="{{ route('order.detail', $order->id) }}" class="text-navy hover:text-light-navy font-medium flex items-center">
                                                      <span>View Details</span>
                                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                      </svg>
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                          
                          <!-- Pagination -->
                          @if($totalPages > 1)
                              <div class="flex justify-between items-center mt-6">
                                  <button 
                                      wire:click="prevPage" 
                                      class="flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-300 {{ $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                      {{ $currentPage == 1 ? 'disabled' : '' }}>
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                      </svg>
                                      Previous
                                  </button>
                                  
                                  <div class="flex items-center">
                                      <span class="text-sm text-gray-700 mr-3">
                                          Page {{ $currentPage }} of {{ $totalPages }}
                                      </span>
                                      
                                      <div class="flex space-x-1">
                                          @for ($i = 1; $i <= $totalPages; $i++)
                                              <button 
                                                  wire:click="goToPage({{ $i }})" 
                                                  class="px-3 py-1 rounded-md text-sm font-medium {{ $i == $currentPage ? 'bg-navy text-white' : 'text-gray-700 hover:bg-gray-100' }} transition duration-300">
                                                  {{ $i }}
                                              </button>
                                          @endfor
                                      </div>
                                  </div>
                                  
                                  <button 
                                      wire:click="nextPage" 
                                      class="flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-300 {{ $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' }}"
                                      {{ $currentPage == $totalPages ? 'disabled' : '' }}>
                                      Next
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                      </svg>
                                  </button>
                              </div>
                          @endif
                      @else
                          <div class="py-16 text-center bg-gray-50 rounded-xl">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                              </svg>
                              <h3 class="text-xl font-bold text-navy mb-3">No Orders Yet</h3>
                              <p class="text-gray-500 mb-6 max-w-md mx-auto">It looks like you haven't placed any orders yet. Start exploring our products to find something you'll love!</p>
                              <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-wood hover:bg-light-wood text-navy font-medium rounded-lg shadow transition duration-300">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                      <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                  </svg>
                                  Browse Products
                              </a>
                          </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
  @push('styles')
    <style>
        .custom-banner {
            background-color: #f8f9fa;
            padding: 20px;
        }
        input
        {
           
            box-shadow: 0px 2px 2px rgba(227, 227, 227, 0.45) !important;
            background: rgba(227, 227, 227, 0.38) ;
            border-radius: 2px !important;
            outline: none !important;
            height: 38px;
        }
        textarea
        {
           
            box-shadow: 0px 2px 2px rgba(227, 227, 227, 0.39) !important;
            background: rgba(227, 227, 227, 0.35) ;
            border-radius: 2px !important;
            outline: none !important;
          
        }
    </style>
@endpush

</div>