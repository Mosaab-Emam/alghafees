import React from "react";
import BlogTitleBox from "./BlogTitleBox";
import SearchInBlog from "./SearchInBlog";
import BlogCategories from "../blogCategories/BlogCategories";

const BlogTopSection = () => {
	return (
		<section className='flex md:flex-row flex-col md:mb-[100px] mb-[50px] gap-[50px]'>
			<div className='md:w-[692px] w-[360px] flex flex-col self-center items-start md:gap-[80px] gap-8 '>
				<BlogTitleBox />
				<SearchInBlog autoSearch={true} />
			</div>
			<BlogCategories />
		</section>
	);
};

export default BlogTopSection;
