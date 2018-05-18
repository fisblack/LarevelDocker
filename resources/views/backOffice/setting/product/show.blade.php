{{--
    @author: Parada Susuk (Care)
    @phone: 0835548554
    @email: careparadas@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/product/index.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
@endsection

@section('body')
    <div class="container-back">
      <div class="order">
        <div class="padding">
          <div class="bg shadow radius">
              <div class="header underline">
                    <div class="page-name float-left">
                      <div class="icon float-left">
                         <img src="{{ asset('images/backOffice/setting/product/product.png') }}">
                      </div>

                      <div class="text float-left">
                        Products
                      </div>
                    </div>
                    <div class="delete btn-action float-right border-left">
                        <a href="#"> <img src="{{ asset('images/backOffice/setting/product/delete.png') }}"></a>
                    </div>

                    <div class="add btn-action float-right border-left">
                          <a href="/create">  <img src="{{ asset('images/backOffice/setting/product/add.png') }}"></a>
                    </div>
                    <div class="search float-right">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-btn">
                          <button class="btn btn-default" type="submit">
                                  <img src="{{ asset('images/backOffice/setting/product/search.png') }}">
                          </button>
                        </div>
                      </div>

                    </div>

              </div>
              <div class="list underline">
                <li class="gradient ">
                   
                   
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
                    
                    
                    
                    
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="profile-img float-left">
                          <div class=" txt-center">
                            <img src="{{ asset('images/backOffice/setting/product/cover1.png') }}">
                          </div>
                        </div>
                   
                   
                  
                    <div class="data float-left">
                        
                        <div class="info ">
                          <div class="text">
                              <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">พระเอกในนิยาย...คือคุณชายในชีวิตจริง</span>/<span>Write a Story of us</span></div>
                                   </div>
                                  <div class="detailbook">
                                
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  ">
                                <span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                                <span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม
                                   </div>
                                
                                </div>  
                         
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status col-xs-12 col-sm-12 col-md-4 col-lg-4">
                              <div class="box payment  r ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    </div>
                      <div class="clearfix visible-xs"><div class="hr"></div></div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                    
                    
                      <div class="price col-xs-12 col-sm-6 col-md-5 col-lg-5  txt-center">
                       
                       <div class="price-num">Boys Love</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>
                         
                    <div class="price b col-xs-12 col-sm-6 col-md-5 col-lg-5  txt-center">
                       
                       <div class="price-num">619 บาท</div>
                       <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                    
                   <div class=" col-xs-12 col-sm-12 col-md-2 col-lg-2 txt-center">
                    
                    <div class="print ">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action txt-center">
                     <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12 txt-center">
                      <div class="edit radius b">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      </div>
                         <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12 txt-center">
                      <div class="delete radius b">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                        </div>
                    </div>
                       
                       
                        </div>
                     
                      
                       
                        
          
                             
                    </div>

                </li>
                 <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover2.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">พี่เสียคนดี</span>/<span>Evil Like You</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
             
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                      <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                                 <div class="price float-right">
                       
                       <div class="price-num">Comedy</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
               
 <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover3.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">อ่่อยอยู่ รู้เปล่า?</span>/<span>Hey You</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
            
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                       <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                                  <div class="price float-right">
                       
                       <div class="price-num">Boys Love</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
<!-- frezz -->
               <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover4.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook "><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">ฉีกกฎรัก</span>/<span>ENAMOUR</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
          
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                       <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                                  
                          <div class="price float-right">
                       
                       <div class="price-num">Romance</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
                <li class="gradient gray">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover3.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">อ่่อยอยู่ รู้เปล่า?</span>/<span>Hey You</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
                         
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                      <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                     <div class="price float-right">
                       
                       <div class="price-num">Boys Love</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
                
                
               <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover1.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">พระเอกในนิยาย...คือคุณชายในชีวิตจริง</span>/<span>Write a Story of us</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
                        
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                        <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                      <div class="price float-right">
                       
                       <div class="price-num">Boys Love</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
                 <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover2.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">พี่เสียคนดี</span>/<span>Evil Like You</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
                         
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                     <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                     <div class="price float-right">
                       
                       <div class="price-num">Comedy</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
               
 <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover3.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">อ่่อยอยู่ รู้เปล่า?</span>/<span>Hey You</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
                       
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                   <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                       <div class="price float-right">
                       
                       <div class="price-num">Boys Love</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
<!-- frezz -->
               <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover4.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook "><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">ฉีกกฎรัก</span>/<span>ENAMOUR</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
                        
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                       <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                      <div class="price float-right">
                       
                       <div class="price-num">Romance</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>  
                
                
                
                
                <li class="gradient ">
                    <div class="select float-left">
                        <input type="checkbox" name="" value="">
                    </div>
                    <div class="data float-left">
                        <div class="profile-img float-left">
                          <div class="">
                            <img src="{{ asset('images/backOffice/setting/product/cover1.png') }}">
                          </div>
                        </div>
                        <div class="info float-left">
                          <div class="text">
                              <div class="col col-1 ">
                                <div class="namebook paddding-r10"><d class="paddding-r10">ชื่อเรื่อง:</d><span class="">พระเอกในนิยาย...คือคุณชายในชีวิตจริง</span>/<span>Write a Story of us</span></div>
                                <div class="detailbook"><span class="paddding-r10">กว้างxยาวxสูง</span>4x13x18 ซม<span class="paddding-l50 paddding-r10">น้ำหนัก</span>920 กรัม</div>  
                              </div>
                    

                          </div>
                          <div class="clear"></div>
                          <div class="status">
                              <div class="box payment ">
                                <div class="topic">ประเภท</div>
                                <span class="type">หนังสือใหม่</span>
                              </div>
                              
                          </div>
                        </div>
                                
                                  
                    </div>
          
                    <div class="print float-right">
                     
                      <img class="btn-undo"` src="{{ asset('images/backOffice/setting/product/undo.png') }}">
                    </div>
                    
                    <div class="btn-action float-right">
                      <div class="edit radius">
                            <img src="{{ asset('images/backOffice/setting/product/edit.png') }}">
                      </div>
                      <div class="delete radius">
                              <img src="{{ asset('images/backOffice/setting/product/delete2.png') }}">
                      </div>
                    </div>
                      
                       
                        
                      
                    <div class="price float-right">
                       
                       <div class="price-num">619 บาท</div>
                     <div class="price-txt">ราคา (ปลีก)</div>
                        
                    </div>
                        <div class="price float-right">
                       
                       <div class="price-num">Boys Love</div>
                       <div class="price-txt">หมวด</div>
                        
                    </div>

                </li>
                
                
                
              </div>

                      <div class="pagination-section">

                        <div class="col1  text-align-left-destop">
                            <div class="text">ทั้งหมด <span>10</span> รายการ</div>
                        </div>
                        <div class="col2 text-align-right-destop">
                          <ul class="pagination">
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                              <li><a href="#">..</a></li>
                                <li><a href="#">10</a></li>
                                  <li><a href="#">></a></li>
                          </ul>
                        </div>



                      </div>
          </div>
        </div>

        </div>




    </div>
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/project_name/create.js') }}"></script>
@endsection
