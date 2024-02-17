package com.example.licenta;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;


public class ListAdapter extends RecyclerView.Adapter {
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_boli,parent,false);

        return new ListViewHolder(view);
    }
    public void onBindViewHolder(RecyclerView.ViewHolder holder, int position){
        ((ListViewHolder) holder).bindView(position);

    }
    public int getItemCount(){
        return MainActivity.BoliList.size();
    }
    private class ListViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        private TextView mTextDenumireBoala;
        private TextView mTextDataBoala;
        private TextView mTextTratamentBoala;
        public ListViewHolder(View itemView){
            super(itemView);
            mTextDenumireBoala=(TextView) itemView.findViewById(R.id.textView_denumire_boala);
            mTextDataBoala=(TextView) itemView.findViewById(R.id.textView_data_boala);
            mTextTratamentBoala=(TextView) itemView.findViewById(R.id.textView_tratament_boala);
            itemView.setOnClickListener(this);
        }
        public void bindView(int position){
            mTextDenumireBoala.setText(MainActivity.BoliList.get(position).getDenumire());
            mTextDataBoala.setText(MainActivity.BoliList.get(position).getData());
            mTextTratamentBoala.setText(MainActivity.BoliList.get(position).getTratament());
        }
        public void onClick(View view){

        }
    }
}
