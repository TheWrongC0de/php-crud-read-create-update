
function resetMe() {

  var target = $("#container");
  target.html('');
}

function printConfigurazioni(configurazioni) {

  if (configurazioni.length > 0) {

    resetMe();
  }

  var target = $("#container");

  var template = $("#box-template").html();
  var compiled = Handlebars.compile(template);

  for (var i=0;i<configurazioni.length;i++) {

    var conf = configurazioni[i];
    var confHTML = compiled(conf);

    target.append(confHTML);
  }
}

function getConfigurazioni() {

  $.ajax({

    url: "getAllConfigurazioni.php",
    method: "GET",
    success: function(data) {

      printConfigurazioni(data);
    },
    error: function(error) {

      console.log("error", error);
    }
  });
}

function deleteConf() {

  var me = $(this);
  var id = me.data('id');

  $.ajax({

    url: "deleteConfigurazione.php",
    method: "POST",
    data: { id: id },
    success: function(data) {

      if (data) {

        getConfigurazioni();
      }
    },
    error: function(error) {

      console.log("error", error);
    }
  });
}
function changeConf() {

  var me = $(this);
  var id = me.data('id');

  var newTitle = prompt('new title');
  var newDesc = prompt('new desc');

  $.ajax({

    url: "updateConfigurazione.php",
    method: "POST",
    data: {

      id: id,
      title: newTitle,
      description: newDesc
    },
    success: function(data) {

      if (data) {

        getConfigurazioni();
      }
    },
    error: function(error) {

      console.log("error", error);
    }
  });
}
function newConf() {

  var newTitle = prompt('new title');
  var newDesc = prompt('new desc');

  $.ajax({

    url: "newConfigurazione.php",
    method: "POST",
    data: {

      title: newTitle,
      description: newDesc
    },
    success: function(data) {

      if (data === true) {

        getConfigurazioni();
      } else {

        switch (data) {
          case -1: console.log("conn error"); break;
          case -2: console.log("param error"); break;

          default: console.log("unknow error");

        }
      }
    },
    error: function(error) {

      console.log("error", error);
    }
  });
}

function init() {

  getConfigurazioni();

  $("#newConf").click(newConf);
  $(this).on('click', '.deleteConf', deleteConf);
  $(this).on('click', '.changeConf', changeConf);
}

$(window).ready(init);
