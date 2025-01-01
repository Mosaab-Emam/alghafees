import React from "react";
import BlogCategories from "../../blog/blogCategories/BlogCategories";

const BlogDetailsTopBox = ({ currentBlog }) => {
	return (
		<div className='flex md:flex-row flex-col md:gap-0 gap-[49px] xl:mb-[136px] lg:mb-[80px] mb-[50px]'>
			<div className='xl:w-[745px] lg:w-[570px] w-[360px] md:h-[447px] h-[213.422px]'>
				<img
					className='w-full object-contain'
					src={currentBlog?.image}
					alt={currentBlog?.title}
					loading='lazy'
				/>
			</div>

			<BlogCategories />
		</div>
	);
};

export default BlogDetailsTopBox;
