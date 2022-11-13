"use strict";

const deleteArticle = document.getElementById("delete");
const deleteModal = document.querySelector(".modal");

deleteArticle.addEventListener("click", (e) => {
	e.preventDefault();
	deleteModal.classList.remove("modal--show");
	console.log("clicked!!");
});
