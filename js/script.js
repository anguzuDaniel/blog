"use strict";

console.log("Hello world");
const deleteArticle = document.querySelector(".delete");
const deleteModal = document.querySelector(".modal");
const dropdown = document.querySelector(".dropdown");
const userDropdownBtn = document.querySelector(".admin__content--user");

deleteArticle.addEventListener("click", (e) => {
	e.preventDefault();
	deleteModal.classList.remove("modal--show");
	console.log("clicked!!");
});

userDropdownBtn.addEventListener("click", (e) => {
	e.preventDefault();
	dropdown.style.display = "block";
	console.log("clicked!!");
});
