// Call the dataTables jQuery plugin

// $(document).ready(function () {
//   $.noConflict();

//   $('#myTable').DataTable({
//     stateSave: true,
//     "pagingType": "full_numbers",
//     "lengthMenu": [
//       [10, 25, 50, -1],
//       [10, 25, 50, "All"]
//     ],
//     extend: 'print',
//     customize: function (win) {
//       myprint(win)
//     },
//     dom: 'Bfrtip',

//     buttons: [
//       'pageLength',
//       'copyHtml5',
//       'excelHtml5',
//       'pdfHtml5',
//       'print',

//     ],

//     // "language": {
//     //   "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json"

//     // },




//   });

// });

//scrollTop
$(document).ready(function () {

  var offset = 100;
  var duration = 900;

  $(window).scroll(function () {
    if ($(this).scrollTop() > offset) {
      $('.to-top').fadeIn(duration);

    } else {
      $('.to-top').fadeOut(duration);

    }
  });



  $('.to-top').click(function () {
    $('body').animate({
      scrollTop: 0
    }, 1500);
  });

});


//toggleFullscreen
function toggleFullscreen(elem) {
  elem = elem || document.documentElement;

  if (!document.fullscreenElement && !document.mozFullScreenElement &&
    !document.webkitFullscreenElement && !document.msFullscreenElement) {
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
      elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
      elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}

document.getElementById('btnFullscreen').addEventListener('click', function () {
  toggleFullscreen();
});

document.getElementById('exampleImage').addEventListener('click', function () {
  toggleFullscreen(this);
});




