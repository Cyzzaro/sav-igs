(function (a) {
  a(function () {
    var b = a(window).width();

    function c(h) {
      if (/^#[0-9A-F]{6}$/i.test(h)) {
        return h;
      }
      h = h.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
      if (h === null) {
        return "N/A";
      }

      function i(j) {
        return ("0" + parseInt(j).toString(16)).slice(-2);
      }
      return "#" + i(h[1]) + i(h[2]) + i(h[3]);
    }
    a(".dynamic-color .col").each(function () {
      a(this)
        .children()
        .each(function () {
          var h = a(this).css("background-color"),
            i = a(this).attr("class");
          a(this).html(c(h) + " " + i);
          if (i.indexOf("darken") >= 0 || a(this).hasClass("black")) {
            a(this).css("color", "rgba(255,255,255,.9");
          }
        });
    });
    if (a("nav").length) {
      a(".toc-wrapper").pushpin({
        top: a("nav").height(),
      });
    } else {
      if (a("#index-banner").length) {
        a(".toc-wrapper").pushpin({
          top: a("#index-banner").height(),
        });
      } else {
        a(".toc-wrapper").pushpin({
          top: 0,
        });
      }
    }
    var g = a("#flow-toggle");
    g.click(function () {
      a("#flow-text-demo")
        .children("p")
        .each(function () {
          a(this).toggleClass("flow-text");
        });
    });
    var e = a("#container-toggle-button");
    e.click(function () {
      a("body .browser-window .container, .had-container").each(function () {
        a(this).toggleClass("had-container");
        a(this).toggleClass("container");
        if (a(this).hasClass("container")) {
          e.text("Turn off Containers");
        } else {
          e.text("Turn on Containers");
        }
      });
    });
    // Github Latest Commit
    if ($(".github-commit").length) {
      $.ajax({
        url: "https://api.github.com/repos/Cyzzaro/sav-igs/commits/master",
        dataType: "json",
        success: function (data) {
          sha = data.sha.substring(0, 7);
          shaURL = data.html_url;
          lastcommit = data.commit.message;
          datelastcommit = jQuery.timeago(data.commit.author.date);
          author = data.commit.committer.email;
          avatar =
            '<img src="' +
            data.committer.avatar_url +
            '" class="circle responsive-img avatar">';
          stats = data.stats.total;
          additions = "+" + data.stats.additions;
          deletions = "-" + data.stats.deletions;
          $(".github-commit").find(".date").html(datelastcommit);
          $(".github-commit").find(".sha").html(sha).attr("href", shaURL);
          $(".github-commit").find(".message").html(lastcommit);
          $(".github-commit").find(".author").html(author);
          $(".github-commit").find(".additions").html(additions);
          $(".github-commit").find(".deletions").html(deletions);
          $(".card-panel-git").find(".gh-photo").html(avatar);
        },
      });
    }

    function f() {
      try {
        document.createEvent("TouchEvent");
        return true;
      } catch (h) {
        return false;
      }
    }
    if (f()) {
      a("#nav-mobile").css({
        overflow: "auto",
      });
    }
    var d = document.getElementById("indeterminate-checkbox");
    if (d !== null) {
      d.indeterminate = true;
    }
    a(".slider").slider({
      full_width: true,
    });
    a(".tab-demo").show().tabs();
    a(".parallax").parallax();
    a(".modal-trigger").leanModal();
    a(".scrollspy").scrollSpy();
    a(".button-collapse").sideNav({
      edge: "left",
    });
    a(".datepicker").pickadate({
      selectYears: 20,
    });
    a("select").not(".disabled").material_select();
  });
})(jQuery);
