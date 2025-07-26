    <!-- Main Footer -->
    <footer class="main-footer text-center">
        <strong>Copyright &copy; <?= date('Y'); ?> <a href="#">PerpusKU</a>.</strong>
        All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('adminlte/dist/js/adminlte.min.js'); ?>"></script>

    <!-- SweetAlert2 (Lokal) -->
    <script src="<?= base_url('adminlte/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script>
      // Notifikasi untuk SUKSES
      <?php if(session()->getFlashdata('success')): ?>
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '<?= session()->getFlashdata('success'); ?>',
          timer: 2000,
          showConfirmButton: false
        });
      <?php endif; ?>

      // Notifikasi untuk ERROR UMUM
      <?php if(session()->getFlashdata('error')): ?>
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: '<?= session()->getFlashdata('error'); ?>'
        });
      <?php endif; ?>
      
      // [DIPERBAIKI] Notifikasi untuk ERROR VALIDASI
      <?php if(session()->getFlashdata('validation_error')): ?>
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: '<?= session()->getFlashdata('validation_error'); ?>'
        });
      <?php endif; ?>

      // Fungsi konfirmasi hapus tunggal
      function confirmDelete(url) {
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Data yang dihapus tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonText: 'Batal',
          confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        })
      }

      // [BARU] Script untuk checkbox dan hapus massal
      document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');
        const bookCheckboxes = document.querySelectorAll('.book-checkbox');
        const bulkDeleteForm = document.getElementById('bulk-delete-form');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                bookCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }

        if (bulkDeleteForm) {
            bulkDeleteForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah form submit secara langsung
                
                const checkedBoxes = document.querySelectorAll('.book-checkbox:checked');
                if (checkedBoxes.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak ada data dipilih',
                        text: 'Silakan pilih setidaknya satu buku untuk dihapus.'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus ${checkedBoxes.length} buku. Aksi ini tidak dapat dibatalkan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, hapus semua!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Lanjutkan submit form jika dikonfirmasi
                    }
                });
            });
        }
      });
 
      // [BARU] Fungsi konfirmasi pengembalian buku
      function confirmReturn(url) {
        Swal.fire({
          title: 'Konfirmasi Pengembalian',
          text: "Apakah Anda yakin buku ini sudah dikembalikan?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonText: 'Batal',
          confirmButtonText: 'Ya, sudah kembali!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        })
      }
    </script>
    </body>
    </html>