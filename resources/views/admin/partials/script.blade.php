  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- <script src="{{ asset('assets/js/select2.min.js') }}"></script> --}}
  <!-- jQuery (Select2 requires jQuery) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- JS FILES -->
  <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/Chart.extension.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.js.map') }}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>

  <script>
      function confirmDelete(formId) {
          Swal.fire({
              title: 'Are you sure?',
              text: "This action cannot be undone!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#6c757d',
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'Cancel'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById(formId).submit();
              }
          });
      }
  </script>
  <script>
      var ctx1 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
      gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
      new Chart(ctx1, {
          type: "line",
          data: {
              labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              datasets: [{
                  label: "Mobile apps",
                  tension: 0.4,
                  borderWidth: 0,
                  pointRadius: 0,
                  borderColor: "#5e72e4",
                  backgroundColor: gradientStroke1,
                  borderWidth: 3,
                  fill: true,
                  data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                  maxBarThickness: 6

              }],
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: false,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5]
                      },
                      ticks: {
                          display: true,
                          padding: 10,
                          color: '#fbfbfb',
                          font: {
                              size: 11,
                              family: "Open Sans",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: false,
                          drawOnChartArea: false,
                          drawTicks: false,
                          borderDash: [5, 5]
                      },
                      ticks: {
                          display: true,
                          color: '#ccc',
                          padding: 20,
                          font: {
                              size: 11,
                              family: "Open Sans",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });
  </script>
  <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
              damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  {{-- @if (session('toast'))
      <script>
          const toast = @json(session('toast'));

          if (toast.type === 'success') {
              showSuccessToast(toast.message);
          } else {
              showErrorToast(toast.message);
          }
      </script>
  @endif --}}
  @if (session('toast'))
      <script>
          (function() {
              const toast = @json(session('toast'));

              console.log('Toast Data from Session:', toast);

              // Get configuration from toast object
              const config = toast.config || {};

              console.log('Toast Configuration:', config);

              // Debug: Show what's being used
              console.log('Using position:', config.position || 'top-end');
              console.log('Using background:', config.background || '#28a745');
              console.log('Using text color:', config.text_color || getContrastColor(config.background || '#28a745'));

              // Use SweetAlert2 with dynamic configuration
              Swal.fire({
                  title: toast.title,
                  text: toast.message,
                  icon: config.icon || toast.type,
                  toast: true,
                  position: config.position || 'top-end',
                  showConfirmButton: config.show_confirm_button || false,
                  timer: config.time || 3000,
                  timerProgressBar: config.timer_progress_bar !== false,
                  background: config.background || '#28a745',
                  color: config.text_color || getContrastColor(config.background || '#28a745'),
                  customClass: {
                      popup: 'dynamic-toast',
                      icon: 'toast-icon'
                  },
                  showClass: {
                      popup: getAnimationClass(config.animation || 'slide-from-top')
                  },
                  hideClass: {
                      popup: 'animate__fadeOut'
                  },
                  width: config.width || '350px',
                  padding: config.padding || '1rem',
                  didOpen: (toastElement) => {
                      console.log('Toast Opened - Element:', toastElement);

                      // Apply custom border color
                      if (config.border_color) {
                          console.log('Applying border color:', config.border_color);
                          toastElement.style.border = `2px solid ${config.border_color}`;
                          toastElement.style.borderRadius = '0.375rem';
                      }

                      // Apply custom icon color
                      const iconElement = toastElement.querySelector('.swal2-icon');
                      if (iconElement && config.icon_color) {
                          console.log('Applying icon color:', config.icon_color);
                          iconElement.style.color = config.icon_color;
                          iconElement.style.borderColor = config.icon_color;
                      }

                      // Apply custom progress bar color
                      const progressBar = toastElement.querySelector('.swal2-timer-progress-bar');
                      if (progressBar && config.background) {
                          progressBar.style.background = getContrastColor(config.background);
                      }
                  }
              });

              // Helper function for contrast color
              function getContrastColor(hexColor) {
                  // Remove # if present
                  hexColor = hexColor.replace('#', '');

                  // Ensure valid hex color
                  if (hexColor.length !== 6) {
                      console.warn('Invalid hex color:', hexColor);
                      return '#000000';
                  }

                  // Convert hex to RGB
                  const r = parseInt(hexColor.substr(0, 2), 16);
                  const g = parseInt(hexColor.substr(2, 2), 16);
                  const b = parseInt(hexColor.substr(4, 2), 16);

                  // Calculate luminance
                  const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

                  // Return black or white based on luminance
                  return luminance > 0.5 ? '#000000' : '#FFFFFF';
              }

              // Get animation class based on configuration
              function getAnimationClass(animation) {
                  const animations = {
                      'slide-from-top': 'animate__slideInDown',
                      'slide-from-bottom': 'animate__slideInUp',
                      'slide-from-left': 'animate__slideInLeft',
                      'slide-from-right': 'animate__slideInRight',
                      'fade-in': 'animate__fadeIn',
                      'zoom-in': 'animate__zoomIn',
                      'bounce': 'animate__bounceIn'
                  };

                  return `animate__animated ${animations[animation] || 'animate__slideInDown'}`;
              }

              // Add animate.css if not already loaded
              if (!document.querySelector('link[href*="animate.css"]')) {
                  const link = document.createElement('link');
                  link.rel = 'stylesheet';
                  link.href = 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
                  document.head.appendChild(link);
              }
          })();
      </script>

      <style>
          .dynamic-toast {
              font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
              box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
          }

          .toast-icon {
              width: 1.5em !important;
              height: 1.5em !important;
              font-size: 1.2rem !important;
          }

          .swal2-timer-progress-bar {
              height: 0.25rem !important;
          }
      </style>
  @endif

  <script>
      // Global AJAX setup for session handling
      $(document).ready(function() {
          // Intercept all AJAX requests
          $.ajaxSetup({
              statusCode: {
                  401: function(response) {
                      if (response.responseJSON && response.responseJSON.session_expired) {
                          // Show modal with redirect option
                          showSessionExpiredModal(response.responseJSON.redirect_url);
                      }
                  },
                  419: function() {
                      // CSRF token mismatch - session expired
                      showSessionExpiredModal(loginUrl);
                  }
              }
          });

          // Session expired modal
          function showSessionExpiredModal(redirectUrl) {
              // Remove any existing modal
              $('#sessionExpiredModal').remove();

              // Create modal HTML
              var modalHtml = `
            <div class="modal fade" id="sessionExpiredModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Session Expired</h5>
                        </div>
                        <div class="modal-body">
                            <p>Your session has expired. Please login again.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="redirectToLogin">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

              // Add modal to body
              $('body').append(modalHtml);

              // Show modal
              var modal = new bootstrap.Modal(document.getElementById('sessionExpiredModal'));
              modal.show();

              // Redirect on OK click
              $('#redirectToLogin').click(function() {
                  window.location.href = redirectUrl || '/login';
              });

              // Auto redirect after 5 seconds
              setTimeout(function() {
                  if ($('#sessionExpiredModal').is(':visible')) {
                      window.location.href = redirectUrl || '/login';
                  }
              }, 5000);
          }

          // Auto-check session every minute
          setInterval(function() {
              $.ajax({
                  url: '/check-session',
                  method: 'GET',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              }).fail(function(xhr) {
                  if (xhr.status === 401 || xhr.status === 419) {
                      // Session expired
                      showSessionExpiredModal('/login');
                  }
              });
          }, 60000); // Check every minute
      });
  </script>
  @stack('scripts')
  @include('admin.partials.ckeditor')
