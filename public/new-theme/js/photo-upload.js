const INPUT_FILE_ASSESSED = document.querySelector('#upload-files-assessed');
const INPUT_FILE_PRE = document.querySelector('#upload-files-pre');
const INPUT_CONTAINER_ASSESSED = document.querySelector('#upload-container-assessed');
const INPUT_CONTAINER_PRE = document.querySelector('#upload-container-pre');
const FILES_LIST_CONTAINER_ASSESSED = document.querySelector('#files-list-container-assessed');
const FILES_LIST_CONTAINER_PRE = document.querySelector('#files-list-container-pre');
let FILES_ASSESSED = [];
let FILES_PRE = [];
const FILE_LIST_ASSESSED = [];
const FILE_LIST_PRE = [];
let UPLOADED_FILES_ASSESSED = [];
let UPLOADED_FILES_PRE = [];

const multipleEvents = (element, eventNames, listener) => {
    const events = eventNames.split(' ');

    events.forEach(event => {
        element.addEventListener(event, listener, false);
    });
};

const assessedPreviewImages = () => {
    FILES_LIST_CONTAINER_ASSESSED.innerHTML = '';
    if (FILE_LIST_ASSESSED.length > 0) {
        FILE_LIST_ASSESSED.forEach((addedFile, index) => {
            const content = `

        <div class="form__image-container" data-index="${index}" style="position: relative;">
            <img class="form__image" src="${addedFile.url}" alt="${addedFile.name}">
                <div class="js-remove-image-assessed" data-index="${index}" style="position: absolute;font-size:25px;top: 0;
                right: 0; color: red;text-shadow: 0px 0px 10px white;">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
        </div>
      `;

            FILES_LIST_CONTAINER_ASSESSED.insertAdjacentHTML('beforeEnd', content);
        });
    } else {
        INPUT_FILE_ASSESSED.value = "";
    }
}


const prePreviewImages = () => {
    FILES_LIST_CONTAINER_PRE.innerHTML = '';
    if (FILE_LIST_PRE.length > 0) {
        FILE_LIST_PRE.forEach((addedFile, index) => {
            const content = `
          <div class="form__image-container" data-index="${index}">
            <img class="form__image" src="${addedFile.url}" alt="${addedFile.name}">
            <div class="js-remove-image-pre" data-index="${index}" style="position: absolute;font-size:25px;top: 0;
            right: 0; color: red;text-shadow: 0px 0px 10px white;">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
          </div>
        `;

            FILES_LIST_CONTAINER_PRE.insertAdjacentHTML('beforeEnd', content);
        });
    } else {
        INPUT_FILE_PRE.value = "";
    }
}

function calling() {
      $('.pre-loader').addClass('d-none')
    $('.pre-loader').removeClass('d-flex')
    $('.pre-loader').removeClass('d-block')
}

const assessedFileUpload = () => {
//     if (FILES_LIST_CONTAINER_ASSESSED) {
//         multipleEvents(INPUT_FILE_ASSESSED, 'click dragstart dragover', () => {
//             INPUT_CONTAINER_ASSESSED.classList.add('active');
//         });

//         multipleEvents(INPUT_FILE_ASSESSED, 'dragleave dragend drop change blur', () => {
//             INPUT_CONTAINER_ASSESSED.classList.remove('active');
//         });

//         INPUT_FILE_ASSESSED.addEventListener('change', () => {
//             const files = [...INPUT_FILE_ASSESSED.files];
//             files.forEach(file => {
               
//                 const fileURL = URL.createObjectURL(file);
//                 const fileName = file.name;

//                 if(file.size > 2048000){

//                     Swal.fire({
//                         position: 'center',
//                         icon: 'error',
//                         title: 'Images must be less than 2MB',
//                     });
//                     return 0;
//                 }else{
                    
//                 if (!file.type.match("image/")) {
//                     alert(file.name + " is not an image");
//                 } else {
//                     const uploadedFiles = {
//                         name: fileName,
//                         url: fileURL,
//                     };
//                      FILES_ASSESSED.push(file);
//                     FILE_LIST_ASSESSED.push(uploadedFiles);
//                 }
//                 }
//             });

//             assessedPreviewImages();
//             UPLOADED_FILES_ASSESSED = document.querySelectorAll(".js-remove-image-assessed");
//             assessedRemoveFile();
//         });
//     }



 if (FILES_LIST_CONTAINER_ASSESSED) {
        multipleEvents(INPUT_FILE_ASSESSED, 'click dragstart dragover', () => {
            INPUT_CONTAINER_ASSESSED.classList.add('active');
        });

        multipleEvents(INPUT_FILE_ASSESSED, 'dragleave dragend drop change blur', () => {
            INPUT_CONTAINER_ASSESSED.classList.remove('active');
        });

        INPUT_FILE_ASSESSED.addEventListener('change', () => {
            const files = [...INPUT_FILE_ASSESSED.files];

            //  for(file of files){
            $('.pre-loader').addClass('d-block')
        //  $('.pre-loader').removeClass('visible')
           $('.pre-loader').removeClass('d-none')
            files.forEach(async file => {

                var fileExtension = file.name.split('.').pop();

                if (fileExtension === 'HEIC' || fileExtension === 'heic') {
                       $('.pre-loader').addClass('d-flex')
                    // $('.pre-loader').removeClass('visible')
                   $('.pre-loader').removeClass('d-none')
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = async function (event) {
                      

                        try {
                            const res = await fetch(event.target.result);
                            const blob = await res.blob();
                            const conversionResult = await heic2any({ blob, toType: "image/jpeg", quality: 0.1 });

                            var img = new Image();
                            img.src = URL.createObjectURL(conversionResult);
                           

                            const uploadedFiles = {
                                name: file.name,
                                url: img.src,
                            };
                            FILES_ASSESSED.push(conversionResult);
                            FILE_LIST_ASSESSED.push(uploadedFiles);
                           
                        }
                        catch (e) {
                            console.error(e);
                        }
                        await assessedPreviewImages();
                        await calling();
                        //   $('.pre-loader').addClass('d-none')
                        UPLOADED_FILES_ASSESSED = document.querySelectorAll(".js-remove-image-assessed");
                        await assessedRemoveFile();
                    }

                }
                else {

                    const fileURL = URL.createObjectURL(file);
                    const fileName = file.name;

                    if (file.size > 2048000) {
                        
                            $('.pre-loader').addClass('d-flex')
                            $('.pre-loader').removeClass('d-none')
                        
                            
                            
                        new Compressor(file, {
                              quality: 0.6,
                         success: function(compressedFile) {
                          var reader = new FileReader();
                          reader.readAsDataURL(compressedFile);
                          reader.onloadend =  async function() {
                         var compressedImage = reader.result;
                        let arr = compressedImage.split(',');
                        let mime = arr[0].match(/:(.*?);/)?.[1];
                        let data = arr[1];

                       let dataStr = atob(data); 
                       let n = dataStr.length;
                       let dataArr = new Uint8Array(n);

                       while (n--) {
                      dataArr[n] = dataStr.charCodeAt(n);
                             }

                       let akl = new File([dataArr], 'File.png', { type: mime });
                         
                         console.log(akl);
                            var img = new Image();
                            img.src = URL.createObjectURL(akl);
                        //  const img = new Image();
                        //  img.src = compressedImage;
                        //   console.log(img.src);
                           const uploadedFiles = {
                                name: file.name,
                                url: img.src,
                            };
                            
                             FILES_ASSESSED.push(akl);
                            FILE_LIST_ASSESSED.push(uploadedFiles);
                            
                            
                             await assessedPreviewImages();
                             await calling();
                            //   $('.pre-loader').addClass('d-none')
                             UPLOADED_FILES_ASSESSED = document.querySelectorAll(".js-remove-image-assessed");
                            await assessedRemoveFile();
                           
    
                      }
                         }
                           });

                            
                            
                            
                            
                           
                        
                        
                        
                        
                        

                        // Swal.fire({
                        //     position: 'center',
                        //     icon: 'error',
                        //     title: "To activate this feature on your device, go to Settings/ Camera/ Format/ and select Most Compatible"
                        // });
                        
                          calling();
                        // return 0;
                    } else {

                        if (!file.type.match("image/")) {
                            alert(file.name + " is not an image");
                             await calling();
                        } else {
                            const uploadedFiles = {
                                name: fileName,
                                url: fileURL,
                            };
                            FILES_ASSESSED.push(file);
                            FILE_LIST_ASSESSED.push(uploadedFiles);
                            assessedPreviewImages();
                             calling();
                            UPLOADED_FILES_ASSESSED = document.querySelectorAll(".js-remove-image-assessed");
                            assessedRemoveFile();
                        }
                    }


                }

            });



            //    await  assessedPreviewImages();
            //     UPLOADED_FILES_ASSESSED = document.querySelectorAll(".js-remove-image-assessed");
            //    assessedRemoveFile();
        });

    }













};

const preFileUpload = () => {
    // if (FILES_LIST_CONTAINER_PRE) {
    //     multipleEvents(INPUT_FILE_PRE, 'click dragstart dragover', () => {
    //         INPUT_CONTAINER_PRE.classList.add('active');
    //     });

    //     multipleEvents(INPUT_FILE_PRE, 'dragleave dragend drop change blur', () => {
    //         INPUT_CONTAINER_PRE.classList.remove('active');
    //     });

    //     INPUT_FILE_PRE.addEventListener('change', () => {
    //         const files = [...INPUT_FILE_PRE.files];
    //         console.log(files);
    //         files.forEach(file => {


    //             const fileURL = URL.createObjectURL(file);
    //             const fileName = file.name;

    //             if(file.size > 2048000){

    //                 Swal.fire({
    //                     position: 'center',
    //                     icon: 'error',
    //                     title: 'Images must be less than 2MB',
    //                 });
    //                 return 0;
    //             }
    //             else{

    //             if (!file.type.match("image/")) {
    //                 alert(file.name + " is not an image");
    //             } else {
    //                 const uploadedFiles = {
    //                     name: fileName,
    //                     url: fileURL,
    //                 };
    //                  FILES_PRE.push(file);
    //                 FILE_LIST_PRE.push(uploadedFiles);
    //                 console.log(FILES_PRE);
    //             }
    //             }
    //         });

    //         prePreviewImages();
    //         UPLOADED_FILES_PRE = document.querySelectorAll(".js-remove-image-pre");
    //         preRemoveFile();
    //     });
    // }
    
    
    if (FILES_LIST_CONTAINER_PRE) {
        multipleEvents(INPUT_FILE_PRE, 'click dragstart dragover', () => {
            INPUT_CONTAINER_PRE.classList.add('active');
        });

        multipleEvents(INPUT_FILE_PRE, 'dragleave dragend drop change blur', () => {
            INPUT_CONTAINER_PRE.classList.remove('active');
        });

        INPUT_FILE_PRE.addEventListener('change', () => {
            const files = [...INPUT_FILE_PRE.files];
             $('.pre-loader').addClass('d-block')
                    // $('.pre-loader').removeClass('visible')
                   $('.pre-loader').removeClass('d-none')
            files.forEach(file => {

                var fileExtension = file.name.split('.').pop();
                
                if (fileExtension === 'HEIC' || fileExtension === 'heic' ) {
                       $('.pre-loader').addClass('d-flex')
                    // $('.pre-loader').removeClass('visible')
                   $('.pre-loader').removeClass('d-none')
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = async function (event) {

                        try {
                            const res = await fetch(event.target.result);
                            const blob = await res.blob();
                            const conversionResult = await heic2any({ blob, toType: "image/jpeg", quality: 0.1 });

                            var img = new Image();
                            img.src = URL.createObjectURL(conversionResult);
                            

                            const uploadedFiles = {
                                name: file.name,
                                url: img.src,
                            };
                            FILES_PRE.push(conversionResult);
                            FILE_LIST_PRE.push(uploadedFiles);
                        }
                        catch (e) {
                            console.error(e);
                        };
                        await prePreviewImages();
                        await calling();
                        UPLOADED_FILES_PRE = document.querySelectorAll(".js-remove-image-pre");
                        await preRemoveFile();
                    };

                } else {
                    const fileURL = URL.createObjectURL(file);
                    const fileName = file.name;

                    if (file.size > 2048000) {
                        
                        
                        
                        
                        
                         $('.pre-loader').addClass('d-flex')
                            $('.pre-loader').removeClass('d-none')
                        
                            
                            
                        new Compressor(file, {
                              quality: 0.6,
                         success: function(compressedFile) {
                          var reader = new FileReader();
                          reader.readAsDataURL(compressedFile);
                          reader.onloadend =  async function() {
                         var compressedImage = reader.result;
                        let arr = compressedImage.split(',');
                        let mime = arr[0].match(/:(.*?);/)?.[1];
                        let data = arr[1];

                       let dataStr = atob(data); 
                       let n = dataStr.length;
                       let dataArr = new Uint8Array(n);

                       while (n--) {
                      dataArr[n] = dataStr.charCodeAt(n);
                             }

                       let akl = new File([dataArr], 'File.png', { type: mime });
                         
                        
                            var img = new Image();
                            img.src = URL.createObjectURL(akl);
                            
                             const uploadedFiles = {
                                name: file.name,
                                url: img.src,
                            };
                        
                         FILES_PRE.push(akl);
                            FILE_LIST_PRE.push(uploadedFiles);
                        await prePreviewImages();
                        await calling();
                        UPLOADED_FILES_PRE = document.querySelectorAll(".js-remove-image-pre");
                        await preRemoveFile();
                        
                          }
                         }
                           });
                        
                        
                        
                        
                        

                        // Swal.fire({
                        //     position: 'center',
                        //     icon: 'error',
                        //     title: "To activate this feature on your device, go to Settings/ Camera/ Format/ and select Most Compatible",
                        // });
                        
                        // return 0;
                    }
                    else {

                        if (!file.type.match("image/")) {
                            alert(file.name + " is not an image");
                              calling();
                        } else {
                            const uploadedFiles = {
                                name: fileName,
                                url: fileURL,
                            };
                            FILES_PRE.push(file);
                            FILE_LIST_PRE.push(uploadedFiles);
                              calling();
                            prePreviewImages();
                            UPLOADED_FILES_PRE = document.querySelectorAll(".js-remove-image-pre");
                            preRemoveFile();
                        }
                    }
                }
            });

            // prePreviewImages();
            // UPLOADED_FILES_PRE = document.querySelectorAll(".js-remove-image-pre");
            // preRemoveFile();
        });
    }
    
    
    
    
    
    
    
    
    
};

const assessedRemoveFile = () => {
    UPLOADED_FILES_ASSESSED = document.querySelectorAll(".js-remove-image-assessed");

    if (UPLOADED_FILES_ASSESSED) {
        UPLOADED_FILES_ASSESSED.forEach(image => {
            image.addEventListener('click', function () {
                const fileIndex = this.getAttribute('data-index');

                FILE_LIST_ASSESSED.splice(fileIndex, 1);
                FILES_ASSESSED.splice(fileIndex, 1);

                assessedPreviewImages();
                assessedRemoveFile();
                console.log(FILE_LIST_ASSESSED);
                console.log(FILES_ASSESSED);
            });
        });
    } else {
        [...INPUT_FILE_ASSESSED.files] = [];
    }
};

const preRemoveFile = () => {
    UPLOADED_FILES_PRE = document.querySelectorAll(".js-remove-image-pre");

    if (UPLOADED_FILES_PRE) {
        UPLOADED_FILES_PRE.forEach(image => {
            image.addEventListener('click', function () {
                const fileIndex = this.getAttribute('data-index');

                FILE_LIST_PRE.splice(fileIndex, 1);
                FILES_PRE.splice(fileIndex, 1);
                prePreviewImages();
                preRemoveFile();
            });
        });
    } else {
        [...INPUT_FILE_PRE.files] = [];
    }
};

assessedFileUpload();
assessedRemoveFile();

preFileUpload();
preRemoveFile();
