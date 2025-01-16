import { Post, Tag } from "@/types";
import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import BlogMainContent from "./BlogMainContent";

const Blog = ({
    posts,
    max_pages,
    tags,
}: {
    posts: Array<Post>;
    max_pages: number;
    tags: Array<Tag>;
}) => {
    useEffect(() => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("search") || urlParams.has("tag")) {
            const element = document.getElementById("search-title");
            if (element) element.scrollIntoView({ behavior: "smooth" });
        }
    }, []);

    return (
        <>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <BlogMainContent posts={posts} max_pages={max_pages} tags={tags} />
        </>
    );
};

Blog.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Blog;
