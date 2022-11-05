$(document).ready(function () {
$(function() {
    $('#btnRight').click(function (e) {
        var selectedOpts = $('#lstBox1 option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#lstBox2').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $('#btnLeft').click(function (e) {
        var selectedOpts = $('#lstBox2 option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#lstBox1').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
});

      $('#btnSiftUp').click(function(e) {
        $('select').moveUpDown('#lstBox2', true, false);
        e.preventDefault();
      });

      $('#btnSiftDown').click(function(e) {
        $('select').moveUpDown('#lstBox2', false, true);
        e.preventDefault();
      });


    $(function() {
      //Moves selected item(s) up or down in a list
      $.fn.moveUpDown = function(list, btnUp, btnDown) {
        var opts = $(list + ' option:selected');
        if (opts.length == 0) {
          alert("Nothing to move");
        }

        if (btnUp) {
          opts.first().prev().before(opts);
        } else if (btnDown) {
          opts.last().next().after(opts);
        }
      };
    });

    function selectAll(selectBox,selectAll) { 
       // have we been passed an ID 
       if (typeof selectBox == "string") { 
           selectBox = document.getElementById(selectBox);
       } 
       // is the select box a multiple select box? 
       if (selectBox.type == "select-multiple" && selectBox.options.length!=0) { 
           for (var i = 0; i < selectBox.options.length; i++) { 
                selectBox.options[i].selected = selectAll; 
           }
           return true;
       }
       
    return true;
}
});