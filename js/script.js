"use strict";

console.log("Hello world");
const deleteArticle = document.querySelector(".delete");
const deleteModal = document.querySelector(".modal");
const dropdown = document.querySelector(".dropdown");
const userDropdownBtn = document.querySelector(".admin__content--user");
const userOptions = document.getElementById("user-options");
const userOptionList = document.querySelector(".user-option-list");

console.log(userOptionList);

if (userOptions != null) {
	userOptions.addEventListener("click", () => {
		console.log("clicked");
		if (userOptionList.style.display == "none") {
			userOptionList.style.display = "block";
		} else {
			userOptionList.style.display = "none";
		}
	});
}

if (deleteArticle !== null) {
	deleteArticle.addEventListener("click", (e) => {
		e.preventDefault();
		deleteModal.classList.remove("modal--show");
		console.log("clicked!!");
	});
}

if (userDropdownBtn !== null) {
	userDropdownBtn.addEventListener("click", (e) => {
		e.preventDefault();
		dropdown.style.display = "block";
		console.log("clicked!!");
	});
}
