import React from "react";
import BlogCard from "../../../../../blog/blogsBox/BlogCard";
import { blogsData } from "../../../../../../data/blogData";

const LatestTopicImagBox = ({ className }) => {
	return (
		<div className={`${className}`}>
			{blogsData.slice(0, 2).map((blog) => (
				<BlogCard key={blog.id} blog={blog} isLatestTopic={true} />
			))}
		</div>
	);
};

export default LatestTopicImagBox;
