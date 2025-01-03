import React from "react";
import { useParams } from "react-router-dom";
import { blogsData } from "../../../data/blogData";

import Layout from "@/Pages/layout/Layout";
import { PageTopSection } from "@/components";
import BlogDetailsTitleBox from "./BlogDetailsTitleBox";
import BlogDetailsTopBox from "./BlogDetailsTopBox";
import ArticleBox from "./articleBox/ArticleBox";
import RelatedTopics from "./relatedTopics/RelatedTopics";

const BlogDetailsPage = ({
    params: { blogId },
}: {
    params: { blogId: string };
}) => {
    const currentBlog = blogsData.find(
        (service) => service.id === Number(blogId)
    );

    return (
        <Layout>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <section className="container md:mt-[211px] top-[6rem] relative">
                <BlogDetailsTopBox currentBlog={currentBlog} />
                <BlogDetailsTitleBox currentBlog={currentBlog} />
                <ArticleBox currentBlog={currentBlog} />
                <RelatedTopics />
            </section>
        </Layout>
    );
};

export default BlogDetailsPage;
