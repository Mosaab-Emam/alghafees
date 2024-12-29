import React from "react";
import { AuthorImg, CalenderIcon } from "../../../assets/images/blog";
import BlogIcon from "../BlogIcon";
import { Button, ParagraphContent } from "../../../components";
import { Link, useNavigate } from "react-router-dom";

const BlogCard = ({ blog, isLatestTopic }) => {
	const navigate = useNavigate();
	return (
		<Link
			to={`/blog/${blog.id}`}
			className='2xl:w-[410px] xl:w-[387px] 2xl:max-h-[570px] lg:w-[340px] w-full max-h-[555px] flex items-center gap-[10px] p-4 rounded-tl-[100px] bg-bg-01 border border-bg-01 shadow-[12px_12px_35px_0px_rgba(29,42,45,0.07)]'>
			<div className='flex flex-col items-start flex-1 gap-6'>
				<div className='h-[226px] self-stretch rounded-tl-[100px]'>
					<img
						className='w-full h-full object-contain rounded-tl-[100px]'
						src={blog.image}
						alt={blog.title}
						loading='lazy'
					/>
				</div>

				<div className='flex flex-col items-start  gap-6 self-stretch'>
					<div className='flex flex-col items-start  gap-4 self-stretch'>
						<div className='flex justify-between items-start self-stretch'>
							<div className='flex items-center gap-2'>
								<CalenderIcon className='w-5 h-5' />
								<p className=' regular-b1 text-right text-Gray-scale-02'>
									{blog.date}
								</p>
							</div>
						</div>

						<svg
							xmlns='http://www.w3.org/2000/svg'
							width='308'
							height='2'
							viewBox='0 0 308 2'
							fill='none'>
							<path d='M307 1H1' stroke='#CFE6EC' strokeLinecap='round' />
						</svg>
					</div>

					<div className='flex flex-col items-start gap-8 self-stretch'>
						<div className='flex flex-col items-start gap-2 self-stretch'>
							<div className='flex  items-center gap-[20px] self-stretch'>
								<BlogIcon color='#51656A' width='24' height='24' />
								<h4 className='head-line-h4 text-right text-Black-01'>
									{blog.title}
								</h4>
							</div>
							{!isLatestTopic && (
								<ParagraphContent>{blog.description}</ParagraphContent>
							)}
						</div>
					</div>

					{!isLatestTopic && (
						<div className='flex justify-between items-center self-stretch'>
							<Button
								onClick={() => navigate(`/blog/${blog.id}`)}
								variant='primary'
								className={
									"h-[40px] md:py-[15px] py-[14px] md:px-[80px] px-[60px]"
								}>
								قراءة المزيد
							</Button>
							<div className='flex items-center gap-4 '>
								<img src={AuthorImg} alt={blog.author} lading='lazy' />
								<p className='regular-b1 text-right text-Gray-scale-02'>
									{blog.author}
								</p>
							</div>
						</div>
					)}
				</div>
			</div>
		</Link>
	);
};

export default BlogCard;
