import React from "react";
import BlogIcon from "../../blog/BlogIcon";
import { CalenderIcon } from "../../../assets/images/blog";
import CategoryIcon from "../../blog/blogCategories/CategoryIcon";

const BlogDetailsTitleBox = ({ currentBlog }) => {
	return (
		<div className='inline-flex md:flex-row flex-col md:items-center items-start 2xl:gap-[288px] xl:gap-[255px] lg:gap-36 gap-4 mb-[28px]'>
			<div className='flex items-center gap-[28px]'>
				<BlogIcon color={"#0F819F"} />
				<h2 className='md:head-line-h2 head-line-h3 text-right text-Black-01'>
					{currentBlog.title}
				</h2>
			</div>

			<div className='xl:w-[387px] lg:w-[350px] w-[360px] py-2 px-8 flex items-center gap-[10px] rounded-tl-[50px]  rounded-br-[50px] border-[3px] border-primary-300 bg-bg-01'>
				<div className='md:w-[323px] w-[360px] flex justify-between items-start'>
					<div className='flex items-center gap-2'>
						<CategoryIcon />

						<p className=' regular-b1 text-right text-primary-600'>
							{currentBlog.category}
						</p>
					</div>
					<div className='flex items-center gap-[9px]'>
						<CalenderIcon className='w-5 h-5' />
						<p className=' regular-b1 text-right text-Gray-scale-02'>
							{currentBlog.date}
						</p>
					</div>
				</div>
			</div>
		</div>
	);
};

export default BlogDetailsTitleBox;
