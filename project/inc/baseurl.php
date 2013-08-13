<script type="text/javascript">
    // BASE URL
    // Change root path as needed
    var baseurl = {
        base : null,
        root : null,
        protocol: null,
    
        init : function(root){
            this.base = window.location.host;
            this.protocol = window.location.protocol + '//'
            this.root = root
            this.url = this.protocol + this.base + this.root
        },
    }
    
    baseurl.init('<?php echo "{$_SERVER['BASE_URL']}"; ?>');
</script>