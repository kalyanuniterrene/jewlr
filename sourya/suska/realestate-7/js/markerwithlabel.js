function MarkerLabel_(e,t,s){this.marker_=e,this.handCursorURL_=e.handCursorURL,this.labelDiv_=document.createElement("div"),this.labelDiv_.style.cssText="position: absolute; overflow: hidden;",this.eventDiv_=document.createElement("div"),this.eventDiv_.style.cssText=this.labelDiv_.style.cssText,this.eventDiv_.setAttribute("onselectstart","return false;"),this.eventDiv_.setAttribute("ondragstart","return false;"),this.crossDiv_=MarkerLabel_.getSharedCross(t)}function MarkerWithLabel(e){e=e||{},e.labelContent=e.labelContent||"",e.labelAnchor=e.labelAnchor||new google.maps.Point(0,0),e.labelClass=e.labelClass||"markerLabels",e.labelStyle=e.labelStyle||{},e.labelInBackground=e.labelInBackground||!1,"undefined"==typeof e.labelVisible&&(e.labelVisible=!0),"undefined"==typeof e.raiseOnDrag&&(e.raiseOnDrag=!0),"undefined"==typeof e.clickable&&(e.clickable=!0),"undefined"==typeof e.draggable&&(e.draggable=!1),"undefined"==typeof e.optimized&&(e.optimized=!1),e.crossImage=e.crossImage||"http://maps.gstatic.com/intl/en_us/mapfiles/drag_cross_67_16.png",e.handCursor=e.handCursor||"http://maps.gstatic.com/intl/en_us/mapfiles/closedhand_8_8.cur",e.optimized=!1,this.label=new MarkerLabel_(this,e.crossImage,e.handCursor),google.maps.Marker.apply(this,arguments)}MarkerLabel_.prototype=new google.maps.OverlayView,MarkerLabel_.getSharedCross=function(e){var t;return"undefined"==typeof MarkerLabel_.getSharedCross.crossDiv&&(t=document.createElement("img"),t.style.cssText="position: absolute; z-index: 1000002; display: none;",t.style.marginLeft="-8px",t.style.marginTop="-9px",t.src=e,MarkerLabel_.getSharedCross.crossDiv=t),MarkerLabel_.getSharedCross.crossDiv},MarkerLabel_.prototype.onAdd=function(){var e,t,s,i,a,r,n,l=this,o=!1,g=!1,_=20,v="url("+this.handCursorURL_+")",d=function(e){e.preventDefault&&e.preventDefault(),e.cancelBubble=!0,e.stopPropagation&&e.stopPropagation()},h=function(){l.marker_.setAnimation(null)};this.getPanes().overlayImage.appendChild(this.labelDiv_),this.getPanes().overlayMouseTarget.appendChild(this.eventDiv_),"undefined"==typeof MarkerLabel_.getSharedCross.processed&&(this.getPanes().overlayImage.appendChild(this.crossDiv_),MarkerLabel_.getSharedCross.processed=!0),this.listeners_=[google.maps.event.addDomListener(this.eventDiv_,"mouseover",function(e){(l.marker_.getDraggable()||l.marker_.getClickable())&&(this.style.cursor="pointer",google.maps.event.trigger(l.marker_,"mouseover",e))}),google.maps.event.addDomListener(this.eventDiv_,"mouseout",function(e){!l.marker_.getDraggable()&&!l.marker_.getClickable()||g||(this.style.cursor=l.marker_.getCursor(),google.maps.event.trigger(l.marker_,"mouseout",e))}),google.maps.event.addDomListener(this.eventDiv_,"mousedown",function(e){g=!1,l.marker_.getDraggable()&&(o=!0,this.style.cursor=v),(l.marker_.getDraggable()||l.marker_.getClickable())&&(google.maps.event.trigger(l.marker_,"mousedown",e),d(e))}),google.maps.event.addDomListener(document,"mouseup",function(t){var s;if(o&&(o=!1,l.eventDiv_.style.cursor="pointer",google.maps.event.trigger(l.marker_,"mouseup",t)),g){if(a){s=l.getProjection().fromLatLngToDivPixel(l.marker_.getPosition()),s.y+=_,l.marker_.setPosition(l.getProjection().fromDivPixelToLatLng(s));try{l.marker_.setAnimation(google.maps.Animation.BOUNCE),setTimeout(h,1406)}catch(r){}}l.crossDiv_.style.display="none",l.marker_.setZIndex(e),i=!0,g=!1,t.latLng=l.marker_.getPosition(),google.maps.event.trigger(l.marker_,"dragend",t)}}),google.maps.event.addListener(l.marker_.getMap(),"mousemove",function(i){var v;o&&(g?(i.latLng=new google.maps.LatLng(i.latLng.lat()-t,i.latLng.lng()-s),v=l.getProjection().fromLatLngToDivPixel(i.latLng),a&&(l.crossDiv_.style.left=v.x+"px",l.crossDiv_.style.top=v.y+"px",l.crossDiv_.style.display="",v.y-=_),l.marker_.setPosition(l.getProjection().fromDivPixelToLatLng(v)),a&&(l.eventDiv_.style.top=v.y+_+"px"),google.maps.event.trigger(l.marker_,"drag",i)):(t=i.latLng.lat()-l.marker_.getPosition().lat(),s=i.latLng.lng()-l.marker_.getPosition().lng(),e=l.marker_.getZIndex(),r=l.marker_.getPosition(),n=l.marker_.getMap().getCenter(),a=l.marker_.get("raiseOnDrag"),g=!0,l.marker_.setZIndex(1e6),i.latLng=l.marker_.getPosition(),google.maps.event.trigger(l.marker_,"dragstart",i)))}),google.maps.event.addDomListener(document,"keydown",function(e){g&&27===e.keyCode&&(a=!1,l.marker_.setPosition(r),l.marker_.getMap().setCenter(n),google.maps.event.trigger(document,"mouseup",e))}),google.maps.event.addDomListener(this.eventDiv_,"click",function(e){(l.marker_.getDraggable()||l.marker_.getClickable())&&(i?i=!1:(google.maps.event.trigger(l.marker_,"click",e),d(e)))}),google.maps.event.addDomListener(this.eventDiv_,"dblclick",function(e){(l.marker_.getDraggable()||l.marker_.getClickable())&&(google.maps.event.trigger(l.marker_,"dblclick",e),d(e))}),google.maps.event.addListener(this.marker_,"dragstart",function(e){g||(a=this.get("raiseOnDrag"))}),google.maps.event.addListener(this.marker_,"drag",function(e){g||a&&(l.setPosition(_),l.labelDiv_.style.zIndex=1e6+(this.get("labelInBackground")?-1:1))}),google.maps.event.addListener(this.marker_,"dragend",function(e){g||a&&l.setPosition(0)}),google.maps.event.addListener(this.marker_,"position_changed",function(){l.setPosition()}),google.maps.event.addListener(this.marker_,"zindex_changed",function(){l.setZIndex()}),google.maps.event.addListener(this.marker_,"visible_changed",function(){l.setVisible()}),google.maps.event.addListener(this.marker_,"labelvisible_changed",function(){l.setVisible()}),google.maps.event.addListener(this.marker_,"title_changed",function(){l.setTitle()}),google.maps.event.addListener(this.marker_,"labelcontent_changed",function(){l.setContent()}),google.maps.event.addListener(this.marker_,"labelanchor_changed",function(){l.setAnchor()}),google.maps.event.addListener(this.marker_,"labelclass_changed",function(){l.setStyles()}),google.maps.event.addListener(this.marker_,"labelstyle_changed",function(){l.setStyles()})]},MarkerLabel_.prototype.onRemove=function(){var e;for(this.labelDiv_.parentNode.removeChild(this.labelDiv_),this.eventDiv_.parentNode.removeChild(this.eventDiv_),e=0;e<this.listeners_.length;e++)google.maps.event.removeListener(this.listeners_[e])},MarkerLabel_.prototype.draw=function(){this.setContent(),this.setTitle(),this.setStyles()},MarkerLabel_.prototype.setContent=function(){var e=this.marker_.get("labelContent");"undefined"==typeof e.nodeType?(this.labelDiv_.innerHTML=e,this.eventDiv_.innerHTML=this.labelDiv_.innerHTML):(this.labelDiv_.innerHTML="",this.labelDiv_.appendChild(e),e=e.cloneNode(!0),this.eventDiv_.appendChild(e))},MarkerLabel_.prototype.setTitle=function(){this.eventDiv_.title=this.marker_.getTitle()||""},MarkerLabel_.prototype.setStyles=function(){var e,t;this.labelDiv_.className=this.marker_.get("labelClass"),this.eventDiv_.className=this.labelDiv_.className,this.labelDiv_.style.cssText="",this.eventDiv_.style.cssText="",t=this.marker_.get("labelStyle");for(e in t)t.hasOwnProperty(e)&&(this.labelDiv_.style[e]=t[e],this.eventDiv_.style[e]=t[e]);this.setMandatoryStyles()},MarkerLabel_.prototype.setMandatoryStyles=function(){this.labelDiv_.style.position="absolute",this.labelDiv_.style.overflow="hidden","undefined"!=typeof this.labelDiv_.style.opacity&&""!==this.labelDiv_.style.opacity&&(this.labelDiv_.style.filter="alpha(opacity="+100*this.labelDiv_.style.opacity+")"),this.eventDiv_.style.position=this.labelDiv_.style.position,this.eventDiv_.style.overflow=this.labelDiv_.style.overflow,this.eventDiv_.style.opacity=.01,this.eventDiv_.style.filter="alpha(opacity=1)",this.setAnchor(),this.setPosition(),this.setVisible()},MarkerLabel_.prototype.setAnchor=function(){var e=this.marker_.get("labelAnchor");this.labelDiv_.style.marginLeft=-e.x+"px",this.labelDiv_.style.marginTop=-e.y+"px",this.eventDiv_.style.marginLeft=-e.x+"px",this.eventDiv_.style.marginTop=-e.y+"px"},MarkerLabel_.prototype.setPosition=function(e){var t=this.getProjection().fromLatLngToDivPixel(this.marker_.getPosition());"undefined"==typeof e&&(e=0),this.labelDiv_.style.left=Math.round(t.x)+"px",this.labelDiv_.style.top=Math.round(t.y-e)+"px",this.eventDiv_.style.left=this.labelDiv_.style.left,this.eventDiv_.style.top=this.labelDiv_.style.top,this.setZIndex()},MarkerLabel_.prototype.setZIndex=function(){var e=this.marker_.get("labelInBackground")?-1:1;"undefined"==typeof this.marker_.getZIndex()?(this.labelDiv_.style.zIndex=parseInt(this.labelDiv_.style.top,10)+e,this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex):(this.labelDiv_.style.zIndex=this.marker_.getZIndex()+e,this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex)},MarkerLabel_.prototype.setVisible=function(){this.marker_.get("labelVisible")?this.labelDiv_.style.display=this.marker_.getVisible()?"block":"none":this.labelDiv_.style.display="none",this.eventDiv_.style.display=this.labelDiv_.style.display},MarkerWithLabel.prototype=new google.maps.Marker,MarkerWithLabel.prototype.setMap=function(e){google.maps.Marker.prototype.setMap.apply(this,arguments),this.label.setMap(e)};