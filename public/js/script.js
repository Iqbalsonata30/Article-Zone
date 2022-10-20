const button          = document.getElementById('btn')
const buttonDropdown  = document.getElementById('dropdown-btn')
const notify          = document.getElementById('message');
const modal           = document.getElementById('my-modal-2');


setTimeout(()=>{
  notify.classList.add('hidden')
},2000)

button.addEventListener('click',()=>{
  buttonDropdown.classList.toggle('hidden')
})
const closeButton = ()=>{
  modal.classList.add('hidden');
}