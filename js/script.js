"use strict";

const deleteArticle = document.querySelector(".delete");
const deleteModal = document.querySelector(".modal");
const dropdown = document.querySelector(".dropdown");
const userDropdownBtn = document.querySelector(".admin__content--user");
const userOptions = document.getElementById("user-options");
const userOptionList = document.querySelector(".user-option-list");
const articleOptions = document.querySelectorAll(".article-options");
// const articleOptions = document.querySelector(".article-options-btn");
const articleOptionList = document.querySelectorAll(".article-option-list");

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

if (articleOptions != null) {
	articleOptions.forEach((btn) => {
		btn.addEventListener("click", (e) => {
			e.preventDefault();
			console.log("clicked");

			articleOptionList.forEach((item) => {
				if (item.style.display == "none") {
					item.style.display = "block";
				} else {
					item.style.display = "none";
				}
			});
		});
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
