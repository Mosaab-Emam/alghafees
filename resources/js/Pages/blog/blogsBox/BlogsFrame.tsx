import React from "react";
import BlogCard from "./BlogCard";
import { blogsData } from "../../../data/blogData";

const BlogsFrame = () => {
	return (
		<section className='xl:w-full lg:w-[1200px] w-full flex md:flex-row flex-col 2xl:justify-start xl:justify-center md:justify-start justify-center md:content-start content-center md:items-start items-center flex-wrap 2xl:gap-x-8 md:gap-y-[50px] gap-y-8 md:gap-x-[20px] md:mb-[61px] mb-8'>
			{blogsData.map((blog) => (
				<BlogCard key={blog.id} blog={blog} />
			))}
		</section>
	);
};

export default BlogsFrame;
