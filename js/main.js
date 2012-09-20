mof = {};

mof.Movies = function() {
    this.rendermode = 'names';
    this.movies = [];
    this.filter = {};
};

mof.Movies.prototype.setRenderMode = function(mode) {
    if(mode != this.rendermode) {
        this.rendermode = mode;
        this.renderMovies();
    }
};

mof.Movies.prototype.renderThumbs = function() {
    var html = '';
    for(var i=0; i<this.movies.length; i++) {
        var m = this.movies[i];
        html += '<div class="movie">';
        if(m['thumb']) {
            html += '<img class="thumb" src="scraper2/Thumbnails/' + m['thumb'] + '"><br>';
        } else {
            html += '<img class="thumb" src="img/placeholder.jpg"><br>';
        }
        html += m['name'];
        html += '</div>';
    }
    return html;
};

mof.Movies.prototype.renderNames = function() {
    var html = '';
    for(var i=0; i<this.movies.length; i++) {
        var m = this.movies[i];
        html += m['name']+'<br>';
    }
    return html;
};

mof.Movies.prototype.renderNames = function() {
    var html = '<table width="100%">';
    for(var i=0; i<this.movies.length; i++) {
        var m = this.movies[i];
        html += m['name']+'<br>';
    }
    html+='</table>';
    return html;
};


mof.Movies.prototype.renderMovies = function() {
    var html = '';
    switch (this.rendermode) {
        case 'thumbs':
            html = this.renderThumbs();
            break;
        case 'names':
            html = this.renderNames();
            break;
        case 'list':
            html = this.renderTable();
            break;
    }

    $('#content').html(html);
};

mof.Movies.prototype.queryMovies = function() {
    $('#throbber').show();
    var that = this;
    var data = this.filter;
    if(this.namefilter) {
        data['name'] = this.namefilter;
    }
    $.getJSON('/scripts/query.php', data, function(data) {
        $('#throbber').hide();
        that.movies = data;
        that.renderMovies();
    });
};

mof.Movies.prototype.setFilter = function(name, val) {
    if(this.filter[name] != val) {
        this.filter[name] = val;
        this.queryMovies();
    }
};
mof.Movies.prototype.setNameFilter = function(val) {
    if(this.namefilter != val) {
        this.namefilter = val;
        this.queryMovies();
    }
};


