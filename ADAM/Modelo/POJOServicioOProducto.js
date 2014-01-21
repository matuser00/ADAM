/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function POJOServicioOProducto(){
        this.id='';    
	this.nombre='';
	this.precio='';	
}



POJOServicioOProducto.prototype.setId     = function(nid){this.id=nid;}
POJOServicioOProducto.prototype.getId     = function(){return this.id;}
POJOServicioOProducto.prototype.setNombre     = function(nnombre){this.nombre=nnombre;}
POJOServicioOProducto.prototype.getNombre     = function(){return this.nombre;}
POJOServicioOProducto.prototype.setPrecio     = function(nprecio){this.precio=nprecio;}
POJOServicioOProducto.prototype.getPrecio     = function(){return this.precio;}
