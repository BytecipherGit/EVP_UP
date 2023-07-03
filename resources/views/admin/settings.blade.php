@extends('company/layouts.app') 
@section('content')
@section('title','EVP - Settings')

    <!--- Main Container Start ----->
    <div class="main-container">

      <div class="main-heading">        
        <div class="row">
          <div class="col-lg-12">
            <h1>Settings</h1>
          </div>
        </div>
      </div><!--- Main Heading ----->  

      <div class="setting-pages">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="applicants-Tab1-tab" data-toggle="tab" href="#applicants-Tab1" role="tab" aria-controls="applicants-Tab1" aria-selected="true">
                  <div class="img-box-iocn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                      <g clip-path="url(#clip0_724_15309)">
                      <path d="M4 13.6084H7V15.6084H4V13.6084ZM9 15.6084H12V13.6084H9V15.6084ZM4 19.6084H7V17.6084H4V19.6084ZM9 19.6084H12V17.6084H9V19.6084ZM4 7.6084H7V5.6084H4V7.6084ZM9 7.6084H12V5.6084H9V7.6084ZM4 11.6084H7V9.6084H4V11.6084ZM9 11.6084H12V9.6084H9V11.6084ZM24 8.6084V24.6084H0V3.6084C0 2.81275 0.31607 2.04969 0.87868 1.48708C1.44129 0.924469 2.20435 0.608398 3 0.608398L13 0.608398C13.7956 0.608398 14.5587 0.924469 15.1213 1.48708C15.6839 2.04969 16 2.81275 16 3.6084V5.6084H21C21.7956 5.6084 22.5587 5.92447 23.1213 6.48708C23.6839 7.04969 24 7.81275 24 8.6084ZM14 3.6084C14 3.34318 13.8946 3.08883 13.7071 2.90129C13.5196 2.71376 13.2652 2.6084 13 2.6084H3C2.73478 2.6084 2.48043 2.71376 2.29289 2.90129C2.10536 3.08883 2 3.34318 2 3.6084V22.6084H14V3.6084ZM22 8.6084C22 8.34318 21.8946 8.08883 21.7071 7.90129C21.5196 7.71376 21.2652 7.6084 21 7.6084H16V22.6084H22V8.6084ZM18 15.6084H20V13.6084H18V15.6084ZM18 19.6084H20V17.6084H18V19.6084ZM18 11.6084H20V9.6084H18V11.6084Z" fill="black" class="iconFill"/>
                      </g>
                      <defs>
                      <clipPath id="clip0_724_15309">
                      <rect width="24" height="24" fill="black" transform="translate(0 0.608398)" class="iconFill" />
                      </clipPath>
                      </defs>
                      </svg>
                  </div>  
                  <h2>Company Profile <span>Set up your Company Information</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab2-tab" data-toggle="tab" href="#applicants-Tab2" role="tab" aria-controls="applicants-Tab2" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                      <g clip-path="url(#clip0_725_18719)">
                      <path d="M12.5 6C11.7089 6 10.9355 6.2346 10.2777 6.67412C9.61993 7.11365 9.10723 7.73836 8.80448 8.46927C8.50173 9.20017 8.42252 10.0044 8.57686 10.7804C8.7312 11.5563 9.11216 12.269 9.67157 12.8284C10.231 13.3878 10.9437 13.7688 11.7196 13.9231C12.4956 14.0775 13.2998 13.9983 14.0307 13.6955C14.7616 13.3928 15.3864 12.8801 15.8259 12.2223C16.2654 11.5645 16.5 10.7911 16.5 10C16.5 8.93913 16.0786 7.92172 15.3284 7.17157C14.5783 6.42143 13.5609 6 12.5 6ZM12.5 12C12.1044 12 11.7178 11.8827 11.3889 11.6629C11.06 11.4432 10.8036 11.1308 10.6522 10.7654C10.5009 10.3999 10.4613 9.99778 10.5384 9.60982C10.6156 9.22186 10.8061 8.86549 11.0858 8.58579C11.3655 8.30608 11.7219 8.1156 12.1098 8.03843C12.4978 7.96126 12.8999 8.00087 13.2654 8.15224C13.6308 8.30362 13.9432 8.55996 14.1629 8.88886C14.3827 9.21776 14.5 9.60444 14.5 10C14.5 10.5304 14.2893 11.0391 13.9142 11.4142C13.5391 11.7893 13.0304 12 12.5 12Z" fill="black" class="iconstroke iconFill" />
                      <path d="M12.5003 24.0001C11.6583 24.0044 10.8274 23.8069 10.0774 23.4241C9.32733 23.0413 8.67991 22.4844 8.18931 21.8C4.37831 16.543 2.44531 12.591 2.44531 10.053C2.44531 7.3863 3.50468 4.82877 5.39035 2.94309C7.27603 1.05741 9.83356 -0.00195312 12.5003 -0.00195312C15.1671 -0.00195312 17.7246 1.05741 19.6103 2.94309C21.4959 4.82877 22.5553 7.3863 22.5553 10.053C22.5553 12.591 20.6223 16.543 16.8113 21.8C16.3207 22.4844 15.6733 23.0413 14.9232 23.4241C14.1732 23.8069 13.3424 24.0044 12.5003 24.0001ZM12.5003 2.18105C10.4127 2.18343 8.41133 3.01377 6.93518 4.48992C5.45904 5.96606 4.62869 7.96746 4.62631 10.055C4.62631 12.065 6.51931 15.782 9.95531 20.5211C10.247 20.9228 10.6297 21.2498 11.072 21.4753C11.5144 21.7008 12.0038 21.8183 12.5003 21.8183C12.9968 21.8183 13.4863 21.7008 13.9286 21.4753C14.3709 21.2498 14.7536 20.9228 15.0453 20.5211C18.4813 15.782 20.3743 12.065 20.3743 10.055C20.3719 7.96746 19.5416 5.96606 18.0654 4.48992C16.5893 3.01377 14.5879 2.18343 12.5003 2.18105Z" fill="black" class="iconFill" />
                      </g>
                      <defs>
                      <clipPath id="clip0_725_18719">
                      <rect width="24" height="24" fill="white" class="iconFill" transform="translate(0.5)"/>
                      </clipPath>
                      </defs>
                      </svg>
                  </div>
                  <h2>Address <span>Set up your Address method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab3-tab" data-toggle="tab" href="#applicants-Tab3" role="tab" aria-controls="applicants-Tab3" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" viewBox="0 0 37 37" fill="none">
                      <path d="M18.6186 17.9375V20.8623M18.6186 20.8623L16.2422 23.2387M18.6186 20.8623L20.995 23.2387" stroke="black" class="iconstroke" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M7.35997 30.6846C5.23998 30.6846 1.56923 31.8226 1 32.961V36.163H5.98079" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <path d="M7.35729 30.6846C9.47728 30.6846 12.8292 31.8225 13.3984 32.961V36.163H5.7673" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <circle cx="7.38163" cy="26.2019" r="2.60194" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <path d="M30.36 30.6846C28.24 30.6846 24.5692 31.8226 24 32.961V36.163H28.9808" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <path d="M30.3573 30.6846C32.4773 30.6846 35.8292 31.8225 36.3984 32.961V36.163H28.7673" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <circle cx="30.3816" cy="26.2019" r="2.60194" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <path d="M18.36 7.68457C16.24 7.68457 12.5692 8.82257 12 9.96104V13.163H16.9808" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <path d="M18.3573 7.68457C20.4773 7.68457 23.8292 8.82254 24.3984 9.96101V13.163H16.7673" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      <circle cx="18.3816" cy="3.20194" r="2.60194" stroke="black" class="iconstroke" stroke-width="1.2"/>
                      </svg>
                  </div>
                  <h2>Department <span>Set up your User method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab4-tab" data-toggle="tab" href="#applicants-Tab4" role="tab" aria-controls="applicants-Tab4" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                      <path d="M21.5 16.9698V12.9698C21.4997 11.6263 21.198 10.3 20.6172 9.08853C20.0364 7.87708 19.1912 6.81133 18.144 5.96977H20.777C20.9986 6.34738 21.3385 6.64141 21.7441 6.80635C22.1497 6.97129 22.5983 6.99793 23.0206 6.88215C23.4429 6.76638 23.8152 6.51464 24.0799 6.16591C24.3447 5.81717 24.4871 5.3909 24.4851 4.95306C24.4831 4.51522 24.3369 4.09025 24.069 3.74391C23.8011 3.39758 23.4266 3.1492 23.0033 3.03723C22.58 2.92526 22.1316 2.95593 21.7275 3.12452C21.3235 3.2931 20.9862 3.59017 20.768 3.96977H16.358C16.1397 3.11218 15.6419 2.35177 14.9433 1.80866C14.2446 1.26555 13.3849 0.970703 12.5 0.970703C11.6151 0.970703 10.7554 1.26555 10.0567 1.80866C9.35806 2.35177 8.86027 3.11218 8.642 3.96977H4.223C4.00139 3.59215 3.66148 3.29812 3.25589 3.13318C2.8503 2.96825 2.40166 2.94161 1.9794 3.05738C1.55714 3.17316 1.18483 3.4249 0.92008 3.77363C0.655333 4.12236 0.512923 4.54864 0.514893 4.98647C0.516863 5.42431 0.663104 5.84929 0.930979 6.19562C1.19885 6.54196 1.57342 6.79034 1.9967 6.90231C2.41999 7.01428 2.86837 6.9836 3.27246 6.81502C3.67655 6.64644 4.01379 6.34936 4.232 5.96977H6.856C5.80876 6.81133 4.96362 7.87708 4.38281 9.08853C3.80201 10.3 3.50033 11.6263 3.5 12.9698V16.9698C2.70435 16.9698 1.94129 17.2858 1.37868 17.8484C0.81607 18.4111 0.5 19.1741 0.5 19.9698L0.5 21.9698C0.5 22.7654 0.81607 23.5285 1.37868 24.0911C1.94129 24.6537 2.70435 24.9698 3.5 24.9698H5.5C6.29565 24.9698 7.05871 24.6537 7.62132 24.0911C8.18393 23.5285 8.5 22.7654 8.5 21.9698V19.9698C8.5 19.1741 8.18393 18.4111 7.62132 17.8484C7.05871 17.2858 6.29565 16.9698 5.5 16.9698V12.9698C5.50163 11.7385 5.82801 10.5294 6.44621 9.46453C7.0644 8.39968 7.95254 7.51672 9.021 6.90477C9.36194 7.52974 9.86493 8.05133 10.4771 8.41473C11.0893 8.77812 11.7881 8.96989 12.5 8.96989C13.2119 8.96989 13.9107 8.77812 14.5229 8.41473C15.1351 8.05133 15.6381 7.52974 15.979 6.90477C17.0475 7.51672 17.9356 8.39968 18.5538 9.46453C19.172 10.5294 19.4984 11.7385 19.5 12.9698V16.9698C18.7044 16.9698 17.9413 17.2858 17.3787 17.8484C16.8161 18.4111 16.5 19.1741 16.5 19.9698V21.9698C16.5 22.7654 16.8161 23.5285 17.3787 24.0911C17.9413 24.6537 18.7044 24.9698 19.5 24.9698H21.5C22.2956 24.9698 23.0587 24.6537 23.6213 24.0911C24.1839 23.5285 24.5 22.7654 24.5 21.9698V19.9698C24.5 19.1741 24.1839 18.4111 23.6213 17.8484C23.0587 17.2858 22.2956 16.9698 21.5 16.9698ZM6.5 19.9698V21.9698C6.5 22.235 6.39464 22.4893 6.20711 22.6769C6.01957 22.8644 5.76522 22.9698 5.5 22.9698H3.5C3.23478 22.9698 2.98043 22.8644 2.79289 22.6769C2.60536 22.4893 2.5 22.235 2.5 21.9698V19.9698C2.5 19.7046 2.60536 19.4502 2.79289 19.2627C2.98043 19.0751 3.23478 18.9698 3.5 18.9698H5.5C5.76522 18.9698 6.01957 19.0751 6.20711 19.2627C6.39464 19.4502 6.5 19.7046 6.5 19.9698ZM12.5 6.96977C12.1044 6.96977 11.7178 6.85247 11.3889 6.63271C11.06 6.41294 10.8036 6.10059 10.6522 5.73513C10.5009 5.36968 10.4613 4.96755 10.5384 4.57959C10.6156 4.19163 10.8061 3.83526 11.0858 3.55555C11.3655 3.27585 11.7219 3.08537 12.1098 3.0082C12.4978 2.93103 12.8999 2.97063 13.2654 3.12201C13.6308 3.27338 13.9432 3.52973 14.1629 3.85863C14.3827 4.18753 14.5 4.57421 14.5 4.96977C14.5 5.5002 14.2893 6.00891 13.9142 6.38398C13.5391 6.75905 13.0304 6.96977 12.5 6.96977ZM22.5 21.9698C22.5 22.235 22.3946 22.4893 22.2071 22.6769C22.0196 22.8644 21.7652 22.9698 21.5 22.9698H19.5C19.2348 22.9698 18.9804 22.8644 18.7929 22.6769C18.6054 22.4893 18.5 22.235 18.5 21.9698V19.9698C18.5 19.7046 18.6054 19.4502 18.7929 19.2627C18.9804 19.0751 19.2348 18.9698 19.5 18.9698H21.5C21.7652 18.9698 22.0196 19.0751 22.2071 19.2627C22.3946 19.4502 22.5 19.7046 22.5 19.9698V21.9698Z" fill="black" class="iconFill" />
                      </svg>
                  </div>
                  <h2>Designation <span>Set up your User method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab5-tab" data-toggle="tab" href="#applicants-Tab5" role="tab" aria-controls="applicants-Tab5" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="25" viewBox="0 0 21 25" fill="none">
                      <path d="M15.5 24.9697H5.5C2.743 24.9697 0.5 22.7267 0.5 19.9697V5.96973C0.5 3.21273 2.743 0.969727 5.5 0.969727H15.5C18.257 0.969727 20.5 3.21273 20.5 5.96973V19.9697C20.5 22.7267 18.257 24.9697 15.5 24.9697ZM5.5 2.96973C3.846 2.96973 2.5 4.31573 2.5 5.96973V19.9697C2.5 21.6237 3.846 22.9697 5.5 22.9697H15.5C17.154 22.9697 18.5 21.6237 18.5 19.9697V5.96973C18.5 4.31573 17.154 2.96973 15.5 2.96973H5.5ZM16.5 6.96973C16.5 6.41773 16.052 5.96973 15.5 5.96973H11.5C10.948 5.96973 10.5 6.41773 10.5 6.96973C10.5 7.52173 10.948 7.96973 11.5 7.96973H15.5C16.052 7.96973 16.5 7.52173 16.5 6.96973ZM16.5 12.9697C16.5 12.4177 16.052 11.9697 15.5 11.9697H11.5C10.948 11.9697 10.5 12.4177 10.5 12.9697C10.5 13.5217 10.948 13.9697 11.5 13.9697H15.5C16.052 13.9697 16.5 13.5217 16.5 12.9697ZM16.5 18.9697C16.5 18.4177 16.052 17.9697 15.5 17.9697H11.5C10.948 17.9697 10.5 18.4177 10.5 18.9697C10.5 19.5217 10.948 19.9697 11.5 19.9697H15.5C16.052 19.9697 16.5 19.5217 16.5 18.9697ZM8.5 7.96973V5.96973C8.5 5.41773 8.052 4.96973 7.5 4.96973H5.5C4.948 4.96973 4.5 5.41773 4.5 5.96973V7.96973C4.5 8.52173 4.948 8.96973 5.5 8.96973H7.5C8.052 8.96973 8.5 8.52173 8.5 7.96973ZM8.5 13.9697V11.9697C8.5 11.4177 8.052 10.9697 7.5 10.9697H5.5C4.948 10.9697 4.5 11.4177 4.5 11.9697V13.9697C4.5 14.5217 4.948 14.9697 5.5 14.9697H7.5C8.052 14.9697 8.5 14.5217 8.5 13.9697ZM8.5 19.9697V17.9697C8.5 17.4177 8.052 16.9697 7.5 16.9697H5.5C4.948 16.9697 4.5 17.4177 4.5 17.9697V19.9697C4.5 20.5217 4.948 20.9697 5.5 20.9697H7.5C8.052 20.9697 8.5 20.5217 8.5 19.9697Z" fill="black" class="iconFill" />
                      </svg>
                  </div>
                  <h2>Policies <span>Set up your User method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab7-tab" data-toggle="tab" href="#applicants-Tab7" role="tab" aria-controls="applicants-Tab7" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="25" viewBox="0 0 21 25" fill="none">
                      <path d="M15.5 24.9697H5.5C2.743 24.9697 0.5 22.7267 0.5 19.9697V5.96973C0.5 3.21273 2.743 0.969727 5.5 0.969727H15.5C18.257 0.969727 20.5 3.21273 20.5 5.96973V19.9697C20.5 22.7267 18.257 24.9697 15.5 24.9697ZM5.5 2.96973C3.846 2.96973 2.5 4.31573 2.5 5.96973V19.9697C2.5 21.6237 3.846 22.9697 5.5 22.9697H15.5C17.154 22.9697 18.5 21.6237 18.5 19.9697V5.96973C18.5 4.31573 17.154 2.96973 15.5 2.96973H5.5ZM16.5 6.96973C16.5 6.41773 16.052 5.96973 15.5 5.96973H11.5C10.948 5.96973 10.5 6.41773 10.5 6.96973C10.5 7.52173 10.948 7.96973 11.5 7.96973H15.5C16.052 7.96973 16.5 7.52173 16.5 6.96973ZM16.5 12.9697C16.5 12.4177 16.052 11.9697 15.5 11.9697H11.5C10.948 11.9697 10.5 12.4177 10.5 12.9697C10.5 13.5217 10.948 13.9697 11.5 13.9697H15.5C16.052 13.9697 16.5 13.5217 16.5 12.9697ZM16.5 18.9697C16.5 18.4177 16.052 17.9697 15.5 17.9697H11.5C10.948 17.9697 10.5 18.4177 10.5 18.9697C10.5 19.5217 10.948 19.9697 11.5 19.9697H15.5C16.052 19.9697 16.5 19.5217 16.5 18.9697ZM8.5 7.96973V5.96973C8.5 5.41773 8.052 4.96973 7.5 4.96973H5.5C4.948 4.96973 4.5 5.41773 4.5 5.96973V7.96973C4.5 8.52173 4.948 8.96973 5.5 8.96973H7.5C8.052 8.96973 8.5 8.52173 8.5 7.96973ZM8.5 13.9697V11.9697C8.5 11.4177 8.052 10.9697 7.5 10.9697H5.5C4.948 10.9697 4.5 11.4177 4.5 11.9697V13.9697C4.5 14.5217 4.948 14.9697 5.5 14.9697H7.5C8.052 14.9697 8.5 14.5217 8.5 13.9697ZM8.5 19.9697V17.9697C8.5 17.4177 8.052 16.9697 7.5 16.9697H5.5C4.948 16.9697 4.5 17.4177 4.5 17.9697V19.9697C4.5 20.5217 4.948 20.9697 5.5 20.9697H7.5C8.052 20.9697 8.5 20.5217 8.5 19.9697Z" fill="black" class="iconFill" />
                      </svg>
                  </div>
                  <h2>SMTP <span>Set up your SMTP method</span></h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="applicants-Tab6-tab" data-toggle="tab" href="#applicants-Tab6" role="tab" aria-controls="applicants-Tab6" aria-selected="false">
                  <div class="img-box-iocn"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="25" viewBox="0 0 21 25" fill="none">
                      <rect x="7.29167" y="1.76139" width="5.91667" height="5.91667" rx="2.375" stroke="black" class="iconstroke" stroke-width="1.58333"/>
                      <rect x="13.7917" y="18.2614" width="5.91667" height="5.91667" rx="2.375" stroke="black"  class="iconstroke" stroke-width="1.58333"/>
                      <rect x="0.791667" y="18.2614" width="5.91667" height="5.91667" rx="2.375" stroke="black" class="iconstroke" stroke-width="1.58333"/>
                      <path d="M3.75 17.4697V15.473C3.75 14.5582 3.75712 13.501 4.49956 12.9666C4.70584 12.8181 4.95511 12.7197 5.25 12.7197C6.15 12.7197 12.2917 12.7197 15.25 12.7197C15.75 12.7197 16.75 12.9697 16.75 14.3447C16.75 15.6447 16.75 16.9697 16.75 17.4697" stroke="black" class="iconstroke" stroke-width="1.97917"/>
                      <path d="M10.125 7.96973V12.3447" stroke="black" class="iconstroke" stroke-width="1.58333"/>
                      </svg>
                  </div>
                  <h2>My Plan <span>Set up your Plan method</span></h2>
                </a>
              </li>
            </ul>
          </div>

          <div class="col-lg-9 col-md-8">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="applicants-Tab1" role="tabpanel" aria-labelledby="applicants-Tab1-tab">
                <div class="tab-content-details">
                  <h2>Company Profile</h2>
                  <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
                    @csrf
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if (session()->has('succ'))
                    <div class="alert alert-success">
                        {{ session()->get('succ') }}
                    </div>
                    @endif
                    @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                    @endif
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Registered Company Name</label>
                          <input disabled id="com_name" type="text" class="form-control" placeholder="Company Name" name="org_name" @if ($profile) value="{{ old('org_name',$profile->org_name)}}" @endif autocomplete="org_name" autofocus>
                          {{-- <input type="text" name="com_name" placeholder="Company Name" value="{{ old('com_name') }}" class="form-control"> --}}
                        </div>
                        <div class="col-xl-6 input-mt-from">
                          <label>Brand Name</label>
                          <input type="text" name="brand_name" placeholder="Brand Name"  @if ($profile) value="{{old('brand_name',$profile->brand_name)}}" @endif class="form-control">
                        </div>  
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Website</label>
                          {{-- <div class="input_field"> --}}
                            {{-- <span>http://</span> --}}
                            <input type="text" name="org_web" placeholder="Website"  @if ($profile) value="{{old('org_web',$profile->org_web)}}" @endif class="form-control">
                          {{-- </div> --}}
                        </div> 
                        <div class="col-xl-6 input-mt-from">
                          <label>Domain Name</label>
                          <input type="text" name="domain_name" placeholder="Domain Name" @if ($profile) value="{{old('domain_name',$profile->domain_name)}}" @endif class="form-control">
                        </div>                         
                      </div>
                    </div> 
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Industry</label>
                        
                            <select name="industry" class="form-control">
                              <option  @if($profile->industry ) value="{{ old('industry', $profile->industry) }}" @endif>@if($profile->industry) {{ old('industry', $profile->industry) }} @else Select Industry @endif</option>
                              <option value="IT Company">IT Company</option>
                              <option value="Non it Company">Non IT Company</option>
                             
                            {{-- </div> --}}
                          </select>
                          {{-- </div> --}}
                         </div>

                        <div class="col-xl-6 input-mt-from">
                          <label>Phone Number</label>
                          <input type="text" name="phone_number"  placeholder="Phone Number" @if ($profile) value="{{old('phone_number',$profile->phone_number)}}" @endif class="form-control">
                        </div>  
                      </div>
                    </div>                    
                </div>  
                <div class="tab-content-details">
                  <h2>Company Identity</h2>     
                    <div class="form-group">                      
                      <label>Company Logo</label>
                      <h6>OnePercentPeople displays your company’s logo in your careers page, in emails to candidates as well as some job boards.</h6>

                      <div class="company-pro">
                        <div class="circle">
                         <img class="profile-pic" id="profile-pic" name="company_logo" @if ($profile->company_logo!== Null) value="/image/{{ old('company_logo', $profile->company_logo) }}" src="/image/{{ $profile->company_logo }}" @else src="assets/admin/images/logo.png" @endif >
                       </div>
                       {{-- <p>You can drag or drop <span>your file logo here.</span> </p> --}}
                       <p><b>File type:</b>.jpeg, .pdf, .docs, or .doc</br><b>File Size:</b> Max:10MB</p></label></p>
                       <div class="p-image ml-auto">
                         <span class="upload-button link_color" id="upload-button">Choose File</span>
                          <input class="file-upload"  name="company_logo" id="file-upload" type="file" accept="image/jpg,image/doc,image/pdf"/>
                       </div>
                      </div>

                      {{-- <h6>Only .jpg, .gif, or .png files allowed, no size limit</h6> --}}
                    </div>
                    <div class="form-group">                      
                      <label>Company Description</label>
                      <h6 class="clg-font">This will be used on some job boards and on welcome pages for things like video interviews and assessments.</h6>
                      <textarea class="form-control" placeholder="Enter Description" name="description" rows="5">@if ($profile) {{old('description',$profile->description)}} @endif</textarea>
                 
                      @error('description')
                      <p class="validation">{{ $description }}</p>
                  @enderror
                    </div>
                 
                </div>  
                <div class="tab-button-bx">
                   {{-- <button type="button" class="btn-secondary-cust" href="{{ route('settings') }}">Cancel</button>  --}}
                   <button type="submit" name="profile" class="btn-primary-cust button_background_color"><span class="button_text_color">Save Changes</span></button>
                </div>  
              </form>         
            </div>
           
              <div class="tab-pane fade" id="applicants-Tab2" role="tabpanel" aria-labelledby="applicants-Tab2-tab">
                <div class="tab-content-details">
                  <h2>Address</h2>
                  <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data" id="address_store">
                    @csrf
                 
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-12">
                          <label>Registered Office<span style="color:red">*</span></label>
                          <textarea class="form-control" name="address" @if ($profile->address) value="{{old('address',$profile->address)}}" @endif rows="2" placeholder="Add Registered Office Address">@if ($profile->address) {{old('address',$profile->address)}}@endif</textarea>
                       
                        </div>  
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-12">
                          <label>Corporate Office</label>
                          <textarea class="form-control" name="cor_office_address" @if ($profile->cor_office_address) value="{{old('cor_office_address',$profile->cor_office_address)}}" @endif rows="2" placeholder="Add Corporate Office Address">@if ($profile->cor_office_address) {{old('cor_office_address',$profile->cor_office_address)}} @endif</textarea>
                        </div>  
                       </div>
                     </div>
                
                    <div class="tab-button-bx">
                    {{-- <button class="btn-secondary-cust">Cancel</button>  --}}
                      <button type="submit" name="add_address" class="btn-primary-cust button_background_color mt-5"><span class="button_text_color">Save Changes</span></button>
                    </div> 
                  </form>
                </div>   
              </div>

              <div class="tab-pane fade" id="applicants-Tab3" role="tabpanel" aria-labelledby="applicants-Tab3-tab">
                <div class="tab-content-details">
                  <h2>Department <button class="ml-auto" data-toggle="modal" data-target="#departIdBtn"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></h2>
      
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Department</th>
                          <th>Sub Department</th>
                          <th>Employees</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      @foreach($department as $dept)
                      <input type="hidden" name="id" value="{{ $dept['id'] }}">
                      <tbody>
                       
                        <tr>
                          <td>{{ $dept->department }}</td>
                          <td>{{ $dept->sub_department }}</td>
                          <td>---</td>
                          <td>
                            <span class="d-flex">
                              <button class="border-none" data-toggle="modal" data-target="#departEditBtn{{ $dept['id'] }}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                            </span>
                          </td>
                        </tr>
                       
                      </tbody>
                      @endforeach
                    </table>
                  </div>
                </div>
                {{-- <div class="tab-button-bx">
                   <button class="btn-secondary-cust">Cancel</button> 
                   <button class="btn-primary-cust button_background_color">Change Save</button>
                </div>  --}}

              </div> 

              <div class="tab-pane fade" id="applicants-Tab4" role="tabpanel" aria-labelledby="applicants-Tab4-tab">
                <div class="tab-content-details">
                  <h2>Designation <button class="ml-auto" data-toggle="modal" data-target="#DesignationIdBtn"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></h2>
                 
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Designation</th>
                          <th>Employees</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      @foreach($designat as $desig)
                      <input type="hidden" name="id" value="{{ $desig['id'] }}">
                      <tbody>
                        <tr>
                          <td>{{$desig->designation_name}}</td>
                          <td>--</td>
                          <td>
                            <span class="d-flex">
                              <button class="border-none" data-toggle="modal" data-target="#DesignationEditBtn{{ $desig['id'] }}" ><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                            </span>
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
                  </div>
                </div>
                {{-- <div class="tab-button-bx">
                   <button class="btn-secondary-cust">Cancel</button> 
                   <button class="btn-primary-cust button_background_color">Change Save</button>
                </div>  --}}

              </div> 

              <div class="tab-pane fade" id="applicants-Tab7" role="tabpanel" aria-labelledby="applicants-Tab7-tab">
                <div class="tab-content-details">
                  <h2>SMTP </h2>
                <form method="POST" id="create_smtp_form" action="{{route('create.smtp.details')}}" enctype="multipart/form-data">
                    @csrf

                    {{-- <input type="hidden" id="company_id" name="company_id" value="{{ $smtpDetails ? $smtpDetails->company_id : '' }}" /> --}}
                  <div class="setting-polici-box">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Driver<span style="color:red">*</span></label>
                          <input type="text"  name="driver" placeholder="Driver" value="{{ $smtpDetails ? $smtpDetails->driver : ''}}" class="form-control">
                          <strong class="error" id="driver-error"></strong>
                        </div>

                        <div class="col-xl-6 input-mt-from">
                          <label>Host<span style="color:red">*</span></label>
                          <input type="text" name="host" placeholder="Host Name" value="{{ $smtpDetails ? $smtpDetails->host : ''}}" class="form-control">
                          <strong class="error" id="host-error"></strong>
                        </div>  
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Port<span style="color:red">*</span></label>      
                            <input type="text" name="port" placeholder="Port Name" value="{{ $smtpDetails ? $smtpDetails->port : ''}}" class="form-control">
                            <strong class="error" id="port-error"></strong>
                        </div> 

                        <div class="col-xl-6 input-mt-from">
                          <label>From Name<span style="color:red">*</span></label>
                          <input type="text" name="from_name" placeholder="Name" value="{{ $smtpDetails ? $smtpDetails->from_name : ''}}"  class="form-control">
                          <strong class="error" id="from_name-error"></strong>
                        </div>                         
                      </div>
                    </div> 
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>From Address<span style="color:red">*</span></label>
                           <input type="text" name="from_address" placeholder="Address" value="{{ $smtpDetails ? $smtpDetails->from_address : ''}}" class="form-control">
                           <strong class="error" id="from_address-error"></strong>
                         </div>

                        <div class="col-xl-6 input-mt-from">
                          <label>Encryption<span style="color:red">*</span></label>
                          {{-- <input type="text" name="encryption"  placeholder="Encryption" value="{{ $smtpDetails ? $smtpDetails->encryption : ''}}" class="form-control"> --}}
                          <select class="form-control" name="encryption" id="encryption">
                            <option value="{{ $smtpDetails ? $smtpDetails->encryption : ''}}">{{ $smtpDetails ? $smtpDetails->encryption : 'Select encryption'}}</option>
                            <option value="ssl">ssl</option>
                            <option value="tls">tls</option>
                        </select>
                          <strong class="error" id="encryption-error"></strong>
                        </div>  
                      </div>
                    </div>  

                    <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>User Name<span style="color:red">*</span></label>
                           <input type="text" name="username" placeholder="User Name" value="{{ $smtpDetails ? $smtpDetails->username : ''}}" class="form-control">
                           <strong class="error" id="username-error"></strong>
                         </div>

                        <div class="col-xl-6 input-mt-from">
                          <label>Password<span style="color:red">*</span></label>
                          <input type="password" name="password"  placeholder="Password" value="{{ $smtpDetails ? $smtpDetails->password : ''}}"  class="form-control">
                          <strong class="error" id="password-error"></strong>
                        </div>  
                      </div>
                    </div>  
                 </div>

                  <div class="tab-button-bx">
                    {{-- <button type="button" class="btn-secondary-cust" href="{{ route('settings') }}">Cancel</button>  --}}
                    <button type="submit" class="btn-primary-cust button_background_color mt-5"><span class="button_text_color">Update Changes</span></button>
                  </div>  
                </form>
                </div>
              </div> 


              <div class="tab-pane fade" id="applicants-Tab5" role="tabpanel" aria-labelledby="applicants-Tab5-tab">
                <div class="tab-content-details">
                  <h2>Policies </h2>
                  <div class="setting-polici-box">
                    <h3>What is Lorem Ipsum?</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<p>
                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <ul>
                      <li>Contrary to popular belief, Lorem Ipsum is not simply random text.</li>
                      <li>It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. </li>
                      <li>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. </li>
                      <li>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. </li>
                      <li>This book is a treatise on the theory of ethics, very popular during the Renaissance. </li>
                      <li>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</li>
                    </ul>
                    <h3>Where can I get some?</h3>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                  </div>

                </div>
                <!-- <div class="tab-button-bx">
                   <button class="btn-secondary-cust">Cancel</button> <button class="btn-primary-cust button_background_color">Save</button>
                </div>  -->

              </div> 

            <div class="tab-pane fade" id="applicants-Tab6" role="tabpanel" aria-labelledby="applicants-Tab6-tab">
              <div class="tab-content-details">
                  <h2>My Plan</h2>
                <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data">
                    @csrf
                   <div class="form-group">
                      <div class="row">
                        <div class="col-xl-6">
                          <label>Plan Name</label>
                          <input type="text" name="plan_name" placeholder="Plan" @if ($plans) value="{{old('plan_name',$plans->plan_name)}}" @endif class="form-control">
                          {{-- <input type="text" name="plan" @if ($plans) value="{{ old('plan'), $plans->plan }}" @endif class="form-control"> --}}
                        </div> 
                         <div class="col-xl-6 input-mt-from">
                          <label>Authority</label>
                          {{-- <div class="selectBox active"> --}}
                            <select name="authority" class="form-control">
                              <option value="1"  @if ($plans) {{ $plans->authority == '1' ? 'selected' : '' }} @endif>01</option>
                              <option value="2"  @if ($plans) {{ $plans->authority == '2' ? 'selected' : '' }} @endif>02</option>
                              <option value="3"  @if ($plans) {{ $plans->authority == '3' ? 'selected' : '' }} @endif>03</option>
                              <option value="4"  @if ($plans) {{ $plans->authority == '4' ? 'selected' : '' }} @endif>04</option>
                              <option value="5"  @if ($plans) {{ $plans->authority == '5' ? 'selected' : '' }} @endif>05</option>
                            </select>
                        {{-- </div>  --}}
                         </div>
                      </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xl-12">
                              <label>Change My Plan</label>
                              <select name="plan_type" @if ($plans) value="{{ old('plan_type' , $plans->plan_type) }}" @endif class="form-control">
                                  <option value="gold" @if ($plans) {{ $plans->plan_type == 'gold' ? 'selected' : '' }} @endif >Gold 01</option>
                                  <option value="silver" @if ($plans) {{ $plans->plan_type == 'silver' ? 'selected' : '' }} @endif >Silver 02</option>
                                  <option value="bronze" @if ($plans) {{ $plans->plan_type == 'bronze' ? 'selected' : '' }}@endif >Bronze 03</option>
                            
                              </select>
                            </div> 
                          </div>
                        </div>
                    </div>   
                      <div class="tab-button-bx mt-5">
                      {{-- <button class="btn-secondary-cust">Cancel</button>  --}}
                      <button type="submit" name="plan" class="btn-primary-cust button_background_color"><span class="button_text_color">Save Changes</span></button>
                      </div>   
                 </form>   
              </div>       
            </div> 
          </div>
        </div>
      </div>  

    </div><!--- Main Container Close ----->
 
  <!-- The Modal Add New Department -->
  <div class="modal fade custu-modal-popup" id="departIdBtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add New Department</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data" id="department_store">
              @csrf
              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Department Name</label>
                    <input type="text" name="department" class="form-control" placeholder="Department Name">
                  </div>
                  <div class="col-md-6">
                    <label>Sub Department Name</label>
                    <input type="text" name="sub_department" class="form-control" placeholder="Sub Department Name">
                  </div>
                </div>                
              </div>
           
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="dept" class="btn-primary-cust button_background_color"><span class="button_text_color">Save Changes</span></button>
        </div>
      </div>
    </div>
  </div>   
</form>
  <!-- The Modal Reporting Manager-->
  @foreach($department as $dept)
  <div class="modal fade custu-modal-popup" id="departEditBtn{{ $dept['id'] }}" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Department</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data" id="department_edit">
              @csrf
              <input type="hidden" name="id" value="{{ $dept['id'] }}">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Department Name</label>
                    <input type="text" name="department" value="{{ old('department' , $dept->department) }}" class="form-control" placeholder="Department Name">
                  </div>
                  <div class="col-md-6">
                    <label>Sub Department Name</label>
                    <input type="text" name="sub_department" value="{{ old('sub_department' , $dept->sub_department) }}" class="form-control" placeholder="Sub Department Name">
                  </div>
                </div>                
              </div>
           
          </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button> --}}
          <button type="submit" name="department_edit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save Changes</span></button>
        </div>
      </div>
    </div>
  </div>
</form>
@endforeach
  <!-- The Modal Add Designation Department -->
  <div class="modal fade custu-modal-popup" id="DesignationIdBtn" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Add New Designation</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data" id="designation_store">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Designation Title</label>
                    <input type="text" name="designation_name" class="form-control" placeholder="Title">
                  </div>
                </div>                
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="designation" class="btn-primary-cust button_background_color"><span class="button_text_color">Save Changes</span></button>
        </div>
      </div>
    </div>
  </div>
</form>
  <!-- The Modal Reporting Manager-->
@foreach($designat as $desig)
  <div class="modal fade custu-modal-popup" id="DesignationEditBtn{{$desig['id']}}" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Designation</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="assets/admin/images/close-btn-icon.png">
          </button>
        </div>
        <div class="modal-body">
          <div class="comman-body">
            <form method="POST" action="{{ route('update_company_profile') }}" enctype="multipart/form-data" id="designation_edit">
              @csrf
              <input type="hidden" name="id" value="{{ $desig['id'] }}">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Designation</label>
                    <input type="text" name="designation_name" class="form-control" value="{{ old('designation_name', $desig->designation_name) }}" >
                  </div>
                  {{-- <div class="col-md-6">@if ($profile) value="{{old('phone',$profile->phone)}}" @endif class="form-control" required
                    <label>Employee</label>
                    <input type="text" name="" class="form-control" value="05">
                  </div> --}}
                </div>                
              </div>
           
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
          <button type="submit" name="desig_edit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save Changes</span></button>
        </div>
      </div>
    </div>
  </div> 
</form> 
@endforeach
@endsection
@section('pagescript')
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
      window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script> 

    <script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>

    <script>
      $(".selectBox").on("click", function(e) {
        $(this).toggleClass("show");
        var dropdownItem = e.target;
        var container = $(this).find(".selectBox__value");
        container.text(dropdownItem.text);
        $(dropdownItem)
          .addClass("active")
          .siblings()
          .removeClass("active");
      });
    </script>

<script>
  $(document).ready(function() {

      $("#create_smtp_form").validate({
          rules: {
              driver: "required",
              port: "required",
              host: "required",
              from_name: "required",
              from_address: "required",
              encryption: "required",
              username: "required",
              password: "required",
           
          },

          messages: {

            driver: "Driver name is required",
            port: "Port is required",
            host: "Host is required",
            from_name: "name is required",
            from_address: "Address is required",
            encryption: "Encryption type is required",
            username: "Username is required",
            password: "Password is required",

          }
         });

         $("#address_store").validate({
          rules: {
            address: "required", 
          },

          messages: {

            address: "Address is required",

          }
         });

         $("#department_store").validate({
          rules: {
            department: "required", 
            sub_department: "required", 
          },

          messages: {

            department: "Department is required",
            sub_department: "Sub department is required", 

          }
         });

         $("#department_edit").validate({

            rules: {
              department: "required", 
              sub_department: "required", 
            },

            messages: {
            department: "Department is required",
            sub_department: "Sub department is required", 

          }
         });

         $("#designation_store").validate({

              rules: {
                designation_name: "required", 
              },

              messages: {
                designation_name: "Department is required",
          
              }
           });

           $("#designation_edit").validate({

              rules: {
                designation_name: "required", 
              },

              messages: {
                designation_name: "Department is required",

              }
              });

    });

</script>
@stop