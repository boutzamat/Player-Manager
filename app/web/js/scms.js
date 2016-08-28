/**
 * @requires JABB 0.3
 */
function SCMS () {
    var d = window.document;	
    this.options = {};
    this.version = "0.1";
	
    this.getVersion = function () {
        return this.version;
    };

    this.bindRiders = function () {
        var self = this;
        
        if(d.getElementById('sort_id') && d.getElementById('filter_id')){
            JABB.Utils.addEvent(d.getElementById('sort_id'), 'change', function(e){
                var $this = this;
                var qs = "&sort="+ $this[$this.selectedIndex].value +"&filter="+d.getElementById('filter_id')[d.getElementById('filter_id').selectedIndex].value;
                JABB.Ajax.sendRequest(self.options.get_riders_url + qs, function (req) {
                    d.getElementById(self.options.section_content_container).innerHTML = req.responseText;
                    self.bindRiders();
                });
            });
            
            JABB.Utils.addEvent(d.getElementById('filter_id'), 'change', function(e){
                var $this = this;
                var qs = "&filter="+ $this[$this.selectedIndex].value +"&sort="+d.getElementById('sort_id')[d.getElementById('sort_id').selectedIndex].value;
                JABB.Ajax.sendRequest(self.options.get_riders_url + qs, function (req) {
                    d.getElementById(self.options.section_content_container).innerHTML = req.responseText;
                    self.bindRiders();
                });
            });
        }
        
        var pages = JABB.Utils.getElementsByClass('pages', d.getElementById(self.options.section_content_container), "a");
        
        for (i = 0, len = pages.length; i < len; i++) {
            JABB.Utils.addEvent(pages[i], 'click', function(e){
                e.preventDefault();
                var $this = this;
                
                var $page = $this.getAttributeNode("rel").value;
                var qs = "&filter="+ d.getElementById('filter_id')[d.getElementById('filter_id').selectedIndex].value +"&sort="+d.getElementById('sort_id')[d.getElementById('sort_id').selectedIndex].value + "&page="+$page;
                JABB.Ajax.sendRequest(self.options.get_riders_url + qs, function (req) {
                    d.getElementById(self.options.section_content_container).innerHTML = req.responseText;
                    self.bindRiders();
                });
                return false;    
            });
        }
    };
		
    this.init = function (calObj) {
        var self = this;
        this.options = calObj;
        JABB.Ajax.sendRequest(calObj.get_riders_url, function (req) {
            d.getElementById(calObj.section_content_container).innerHTML = req.responseText;
            self.bindRiders();
        });
		
    }
}