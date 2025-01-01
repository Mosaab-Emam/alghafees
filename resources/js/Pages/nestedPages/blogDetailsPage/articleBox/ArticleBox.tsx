import React from "react";
import ArticleBoxDetails from "./ArticleBoxDetails";
import ArticleAside from "./articleAside/ArticleAside";

const ArticleBox = ({ currentBlog }) => {
	return (
		<section className='flex md:flex-row flex-col 2xl:gap-12 xl:gap-10 md:gap-5 gap-8 xl:mb-[100px] lg:mb-8 mb-8'>
			<ArticleBoxDetails currentBlog={currentBlog} />
			<ArticleAside />
		</section>
	);
};

export default ArticleBox;
