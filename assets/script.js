/*Điều chỉnh cái chỗ gì mà nó hiện menu ra mấy cái của nữ bên cartegogy*/
document.addEventListener("DOMContentLoaded", function() {
    const itemsliderbar = document.querySelectorAll(".cartegory-left-li");
    itemsliderbar.forEach(function(menu, index) {
        menu.addEventListener("click", function() {
            menu.classList.toggle("block");

        });
    });
});

/*product*/
/*Hiệu ứng chuyển động ảnh */
const bigImg=document.querySelector(".product-content-left-big-img img")
const smalImg=document.querySelectorAll(".product-content-left-small-img img")
smalImg.forEach(function(imgItem,X)
{
    imgItem.addEventListener("click",function()
    {
        bigImg.src = imgItem.src
    })
})

const baoquan = document.querySelector(".baoquan")
const chitiet = document.querySelector(".chitiet")
/*Đoạn if dưới đây có nghĩa là khi mình nhấn vào bảo quản thì cái chi tiết nó sẽ ẩn và chỉ hiện cái thông tin của bảo quản*/
if(baoquan)
{
    baoquan.addEventListener("click",function()
    {
        document.querySelector(".product-content-right-buttom-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-buttom-content-baoquan").style.display = "block"
    })
}
if(chitiet)
{
    chitiet.addEventListener("click",function()
    {
            document.querySelector(".product-content-right-buttom-content-chitiet").style.display = "block"
            document.querySelector(".product-content-right-buttom-content-baoquan").style.display = "none"
    })
}
/*này làm cho đẹp giống mẫu hay sao á để note trong word*/
/*Này nhấn zô là nó mất nhớ cài đặt bên css nữa nha cái activeB bên css là display: none; vs phải cho cái .product-content-right-buttom-top được có curso: pointer*/
const buttom = document.querySelector(".product-content-right-buttom-top")
if(buttom)
{
    buttom.addEventListener("click",function()
    {
        document.querySelector(".product-content-right-buttom-content-big").classList.toggle("activeB")
    })
}
        /*điều chỉnh về dấu chấm chuyển trang á*/

        const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
        const imgContainer = document.querySelector(".aspect-ratio-169 ");
        const dotItem = document.querySelectorAll(".dot");
        let imgNumber = imgPosition.length;
        let index = 0;
        // console.log(ingPosition)
imgPosition.forEach(function(image, index)
{
    image.style.left = index * 100 + "%"
    dotItem[index].addEventListener("click",function()
    {
        Slide(index);

    })
})



function imgSlide()
{
    index++;
    console.log(index)
    if(index>=imgNumber)
    {index=0;}
    Slide(index);
}

function Slide(index)
{
   imgContainer.style.left = "-" + index*100 + "%";
   const doActive = document.querySelector('.click');
   doActive.classList.romove("click");
   //này ấn vào nó hiện trang kế bên 
   dotItem[index].classList.add("click");
}

setInterval(imgSlide,5000);