$("#changesuccess").hide();
$("#changefailure").hide();

$("#default").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'default'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Default");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#amelia").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'amelia'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Amelia");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#cerulean").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'cerulean'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Cerulean");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#cosmo").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'cosmo'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Cosmo");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#cyborg").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'cyborg'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Cyborg");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#darkly").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'darkly'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Darkly");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#flatly").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'flatly'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Flatly");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#journal").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'journal'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Journal");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#lumen").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'lumen'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Lumen");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#readable").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'readable'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Readable");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#simplex").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'simplex'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Simplex");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#slate").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'slate'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Slate");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#spacelab").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'spacelab'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Spacelab");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#superhero").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'superhero'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Superhero");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#united").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'united'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("United");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});
$("#yeti").click(function() {
  $.ajax({
    type: "POST",  
    url: 'backend.php',
    data: {theme:'yeti'},
    dataType: "json",
    context: document.body,
    async: true,
    success: function(res, stato) {
      if (res.success == "1") {
        $("#changesuccess").show();
        $("#themename").html("Yeti");
        window.location.reload();
      } else {
        $("#changefailure").show();
      }
    }
  });
});