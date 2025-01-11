import { Post } from "@/types";
import BlogPagination from "./BlogPagination";
import BlogsBoxTitle from "./BlogsBoxTitle";
import BlogsFrame from "./BlogsFrame";

export default function BlogsBox({ posts }: { posts: Array<Post> }) {
    return (
        <section className="mb-[80px]">
            <BlogsBoxTitle />
            <BlogsFrame posts={posts} />
            <BlogPagination />
        </section>
    );
}
