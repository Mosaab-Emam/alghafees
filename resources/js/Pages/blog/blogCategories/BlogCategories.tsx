import React from "react";
import BlogIcon from "../BlogIcon";
import { blogCategoriesData } from "../../../data/blogData";
import CategoryIcon from "./CategoryIcon";

const BlogCategories = () => {
	return (
		<section className='inline-flex items-center p-8 gap-[10px] rounded-tl-[50px] rounded-br-[50px] bg-bg-01 border-[3px] border-primary-300 xl:mx-auto md:mr-auto'>
			<div className='md:w-[343px] w-[360px] flex flex-col items-start gap-8'>
				<div className='flex items-start gap-4 '>
					<BlogIcon color={"#0F819F"} />
					<h3 className=' head-line-h3 text-right text-Black-01'>اقسامنا</h3>
				</div>

				<div className='flex flex-col items-start self-stretch gap-6'>
					{blogCategoriesData.map((item, index) => (
						<button
							key={item.id}
							className={`${
								index === blogCategoriesData.length - 1
									? ""
									: "border-b border-primary-200"
							} flex  justify-between items-center self-stretch gap-6 pb-2`}>
							<div className='flex items-center gap-[9px]'>
								<CategoryIcon />
								<h3 className='regular-b1 text-right text-primary-600'>
									{item.category}
								</h3>
							</div>

							<p className=' regular-b1 text-right text-Gray-scale-02'>
								{item.blogsCount} مقالات
							</p>
						</button>
					))}
				</div>
			</div>
		</section>
	);
};

export default BlogCategories;
