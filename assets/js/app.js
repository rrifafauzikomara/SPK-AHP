$(document).ready(function() {
  $('#tabeldata').DataTable();
  $(".datepicker").datepicker({ format: "yyyy-mm-dd" });

  var $modal = $('.modal');
  // Show loader & then get content when modal is shown
  $modal.on('show.bs.modal', function(e) {
    var id_alternatif = $(e.relatedTarget).data('id-alternatif');
    $(this)
      .addClass('modal-scrollfix')
      .find('.modal-body')
      .html('loading...')
      .load('data-nilai-awal-detail.php?id=' + id_alternatif, function() {
        // Use Bootstrap's built-in function to fix scrolling (to no avail)
        $modal
          .removeClass('modal-scrollfix')
          .modal('handleUpdate');
      });
  });
});

function showSuccessToast() {
  $().toastmessage('showSuccessToast', "Data telah dihapus");
}

function showStickySuccessToast() {
  $().toastmessage('showToast', {
    text: 'Sukses, Tambah lagi',
    sticky: true,
    position: 'top-right',
    type: 'success',
    closeText: '',
    close: function() {
      console.log("toast is closed ...");
    }
  });
}

function showNoticeToast() {
  $().toastmessage('showNoticeToast', "Kami telah menentukan nilai yang boleh diinput");
}

function showStickyNoticeToast() {
  $().toastmessage('showToast', {
    text: 'Kami telah menentukan nilai yang boleh diinput',
    sticky: true,
    position: 'top-right',
    type: 'notice',
    closeText: '',
    close: function() {
      console.log("toast is closed ...");
    }
  });
}

function showWarningToast() {
  $().toastmessage('showWarningToast', "Peringatan, password anda masukkan salah");
}

function showStickyWarningToast() {
  $().toastmessage('showToast', {
    text: 'Peringatan, password anda masukkan salah',
    sticky: true,
    position: 'top-right',
    type: 'warning',
    closeText: '',
    close: function() {
      console.log("toast is closed ...");
    }
  });
}

function showErrorToast() {
  $().toastmessage('showErrorToast', "Data gagal dihapus, (hapus dulu data yang terkait pada menu lainnya)");
}

function showStickyErrorToast() {
  $().toastmessage('showToast', {
    text: 'Gagal total! Coba lagi',
    sticky: true,
    position: 'top-right',
    type: 'error',
    closeText: '',
    close: function() {
      console.log("toast is closed ...");
    }
  });
}

$('#select-all').click(function(event) {
  if (this.checked) {
    // Iterate each checkbox
    $(':checkbox').each(function() {
      this.checked = true;
    });
  } else {
    $(':checkbox').each(function() {
      this.checked = false;
    });
  }
});

$('#select-all2').click(function(event) {
  if (this.checked) {
    // Iterate each checkbox
    $(':checkbox').each(function() {
      this.checked = true;
    });
  } else {
    $(':checkbox').each(function() {
      this.checked = false;
    });
  }
});

function deleteRecord(table, field, id, reload = false) {
  swal({
    title: "Apakah anda yakin?",
    text: "Data yang dihapus tidak dapat dikembalikan!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya!",
    closeOnConfirm: false
  }, function() {
    $.ajax({
      type: "GET",
      url: "ajax.php",
      data: {
        "table": table,
        "field": field,
        "id": id
      },
      success: function(data) {}
    }).done(function(data) {
      swal("Deleted!", "Data berhasil dihapus!", "success");
      if (reload) {
        location.reload();
      } else {
        $("table#" + table + " tr#" + id).remove();
      }
    }).error(function(data) {
      swal("Oops!", "Maaf koneksi terputus!", "error");
    });
  });
}
