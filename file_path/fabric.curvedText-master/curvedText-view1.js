/***** Required : http://fabricjs.com *****/
//https://github.com/Skritz/fabric.curvedText




var CurvedText = (function() {

    /**
    * Constructor
    * @method curvedText
    * @param canvas
    * @param {object} options
    */
    function CurvedText( canvas, options ){

      // Options
      this.opts = options || {};
      for ( var prop in CurvedText.defaults ) {
         if (prop in this.opts) { continue; }
         this.opts[prop] = CurvedText.defaults[prop];
      }

      this.canvas = canvas;
      this.group = new fabric.Group([], {selectable: this.opts.selectable});
      this.canvas.add( this.group ) ;
      this._forceGroupUpdate();
      this.setText( this.opts.text );
    }


    /**
    * @method set
    * @param {string} param
    * @param value
    * @return false if the param name is unknown
    */
    CurvedText.prototype.set = function( param, value ) {
      if ( this.opts[param] !== undefined ) {
        this.opts[param] = value;
        if ( param === 'fontSize' || param === 'fontWeight' ) {
          this._setFontStyles();
        }
        if ( param === 'selectable' ) {
          this.group.selectable = value;
        }
        if ( param === 'angle' ) {
          this._forceGroupUpdate();
        }

        this._render();
        return true;
      } else {
        return false;
      }
    };
    
    /**
    * @method get
    * @param {string} param
    * @return value of param, or false if unknown
    */
    CurvedText.prototype.get = function( param ) {
      this._render();
      if ( this.opts[param] !== undefined ) {
        return this.opts[param];
      } else {
        return false;
      }
    };
    
    /**
    * @method getParams
    * @return {object} value of every options
    */
    CurvedText.prototype.getParams = function() {
      this._render();
      return this.opts;
    };
    
    /**
    * Center the group in canvas
    * @method center
    * @return {object} with top and left
    */
    CurvedText.prototype.center = function() {
      //alert(this.canvas.height);
      this.opts.top = this.canvas.height / 2;
      this.opts.left = this.canvas.width / 2;
      this._render();
      return { top:this.opts.top, left:this.opts.left };
    };
    
    /**
    * Remove all letters from canvas
    * @method remove
    */
    CurvedText.prototype.remove = function() {
      var size = this.group.size();
      for ( var i=size; i>=0; i-- ){
        this.group.remove( this.group.item(i) );
      }
      this.canvas.renderAll();
    };
    
    /**
    * Used to change the text
    * @method setText
    * @param {string} newText
    */
    CurvedText.prototype.setText = function( newText ) {

      while ( newText.length !== 0 && this.group.size() >= newText.length ) {
        this.group.remove( this.group.item( this.group.size()-1 ) );
      }
      
      for ( var i=0; i<newText.length; i++ ){
        if ( this.group.item(i) === undefined ){
          var letter = new fabric.Text(newText[i], {
            selectable: true
          });
          this.group.add( letter );
        }
        else{
          this.group.item(i).text = newText[i];
        }
      }
      this.opts.text = newText;
      this._setFontStyles();
      this._render();
    };
    
    /**
    * Update font size and weight
    * @private
    * @method _setFontStyles
    */
    CurvedText.prototype._setFontStyles = function() {
      for ( var i=0; i<this.group.size(); i++ ){
        /*this.group.item(i).set("fontsize", this.opts.fontSize );
        this.group.item(i).set("color", '#fff' );*/
        this.group.item(i).fontWeight = this.opts.fontWeight ;
        this.group.item(i).fontSize = this.opts.fontSize ;
        this.group.item(i).fontFamily = 'Bungee' ;
      }
    };

    /**
    * Force update group scale and angles
    * @private
    * @method _forceGroupUpdate
    */
    CurvedText.prototype._forceGroupUpdate = function() {
      this.opts.angle = -0;
      
      this.group.set("angle",this.opts.angle );
      this.group.scaleX = 0.9348010887618413;
      this.group.scaleY = 0.34854389452760204;
      
      this.group.currentWidth = 173.4555747694377;
      this.group.currentHeight = 25.896702229525328;
      this.group.left = 105;
      this.group.top = 105;
      
      this._render();
    };


    /**
    * calculate the position and angle of each letter
    * @private
    * @method _render
    */
    CurvedText.prototype._render = function() {
        var curAngle=0,angleRadians=0, align=0;

        // Object may have been moved with drag&drop
        /*if ( this.group.hasMoved() ) {*/
          this.opts.top = this.group.top;
          this.opts.left = this.group.left;
        /*}*/
        this.opts.angle = -0;
        this.opts.scaleX = this.group.scaleX;
        this.opts.scaleY = this.group.scaleY;


        // Text align
        if ( this.opts.align === 'center' ) {
          align = ( this.opts.spacing / 2) * ( this.group.size() - 1) ;
        } else if ( this.opts.align === 'right' ) {
          align = ( this.opts.spacing ) * ( this.group.size() - 1) ;
        }
        
        for ( var i=0; i<this.group.size(); i++) {
          // Find coords of each letters (radians : angle*(Math.PI / 180)
          if ( this.opts.reverse ) {
            curAngle = (-i * parseInt( this.opts.spacing, 10 )) + align;
            angleRadians = curAngle * (Math.PI / 180);
            this.group.item(i).set( 'top', (Math.cos( angleRadians ) * this.opts.radius) );
            this.group.item(i).set( 'left', (-Math.sin( angleRadians ) * this.opts.radius) );
          } else {
            curAngle = (i * parseInt( this.opts.spacing, 10)) - align;
            angleRadians = curAngle * (Math.PI / 180);
            this.group.item(i).set( 'top', (-Math.cos( angleRadians ) * this.opts.radius) );
            this.group.item(i).set( 'left', (Math.sin( angleRadians ) * this.opts.radius) ) ;
          }

          //alert(curAngle);


          this.group.item(i).set("angle",curAngle );
          
        }
        
        // Update group coords
        this.group._calcBounds();
        this.group._updateObjectsCoords();
        this.group.top = this.opts.top;
        
        this.group.left = this.opts.left;
        this.group.setCoords();

        this.canvas.renderAll();
    };



   
    return CurvedText;





})();
