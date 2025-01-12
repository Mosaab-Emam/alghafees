import { Post } from "@/types";
import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import BlogMainContent from "./BlogMainContent";

const Blog = ({ posts }: { posts: Array<Post> }) => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <Layout>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <BlogMainContent posts={posts} />
        </Layout>
    );
};

export default Blog;
