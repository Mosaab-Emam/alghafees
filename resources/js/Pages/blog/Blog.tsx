import { Post } from "@/types";
import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import BlogMainContent from "./BlogMainContent";

const Blog = ({ posts }: { posts: Array<Post> }) => {
    useEffect(() => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("search")) {
            const element = document.getElementById("search-title");
            if (element) element.scrollIntoView({ behavior: "smooth" });
        }
    }, []);

    return (
        <Layout>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <BlogMainContent posts={posts} />
        </Layout>
    );
};

export default Blog;
