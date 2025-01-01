import React from "react";
import { useParams } from "react-router-dom";
import { blogsData } from "../../../data/blogData";

import BlogDetailsTopBox from "./BlogDetailsTopBox";
import BlogDetailsTitleBox from "./BlogDetailsTitleBox";
import ArticleBox from "./articleBox/ArticleBox";
import RelatedTopics from "./relatedTopics/RelatedTopics";

const BlogDetailsPage = () => {
	const { blogId } = useParams();

	const currentBlog = blogsData.find(
		(service) => service.id === Number(blogId)
	);

	return (
		<section className='container md:mt-[211px] top-[6rem] relative'>
			<BlogDetailsTopBox currentBlog={currentBlog} />
			<BlogDetailsTitleBox currentBlog={currentBlog} />
			<ArticleBox currentBlog={currentBlog} />
			<RelatedTopics />
		</section>
	);
};

export default BlogDetailsPage;
